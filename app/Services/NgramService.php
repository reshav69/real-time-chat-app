<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class NgramService
{
    public $vocab = [];
    public $bigramMap = [];
    public $trigramMap = [];
    public $nextWordsMap = [];

    public function __construct()
    {
        $file = ('storage/ngram-input.txt');
        $this->loadLargeCorpus($file);
    }

    public function textcleaner($text)
    {
        $text = preg_replace('/<[^>]+>/', '', $text);
        $text = preg_replace('/[^\w\s]/u', '', $text);
        $text = strtolower($text);

        return trim($text);
    }

    public function loadLargeCorpus($filePath)
    {
        $handle = fopen($filePath, "r");

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $cleanedLine = $this->textcleaner($line);
                $words = str_word_count($cleanedLine, 1);

                $countWords = count($words);

                for ($i = 0; $i < $countWords; $i++) {
                    $this->vocab[$words[$i]] = true;

                    if ($i < $countWords - 1) {
                        $bigram = $words[$i] . ' ' . $words[$i + 1];
                        $this->bigramMap[$bigram] = ($this->bigramMap[$bigram] ?? 0) + 1;

                        if ($i < $countWords - 2) {
                            $nextWord = $words[$i + 2];
                            $this->nextWordsMap[$bigram][] = $nextWord;

                            $trigram = $words[$i] . ' ' . $words[$i + 1] . ' ' . $words[$i + 2];
                            $this->trigramMap[$trigram] = ($this->trigramMap[$trigram] ?? 0) + 1;
                        }
                    }
                }
            }
            fclose($handle);

            $this->vocab = array_keys($this->vocab);
        } else {
            throw new \Exception("Could not open file: $filePath");
        }
    }

    public function suggestNext($input)
    {
        $inputTokens = explode(" ", strtolower(trim($input)));
        if (count($inputTokens) < 2) {
            return [];
        }

        $lastWord1 = $inputTokens[count($inputTokens) - 2];
        $lastWord2 = $inputTokens[count($inputTokens) - 1];
        $testBigram = $lastWord1 . ' ' . $lastWord2;

        $vocabProbabilities = [];
        foreach ($this->vocab as $vocString) {
            $testTrigram = $lastWord1 . ' ' . $lastWord2 . ' ' . $vocString;
            $testTrigramCount = $this->trigramMap[$testTrigram] ?? 0;
            $testBigramCount = $this->bigramMap[$testBigram] ?? 0;

            // Add-1 Smoothing
            $probability = ($testBigramCount != 0) 
                ? (($testTrigramCount + 1) / ($testBigramCount + count($this->vocab)))
                : 0.0;

            $vocabProbabilities[] = ['word' => $vocString, 'probability' => $probability];
        }

        usort($vocabProbabilities, fn($a, $b) => $b['probability'] <=> $a['probability']);
        return array_slice($vocabProbabilities, 0, 3);
    }

}
