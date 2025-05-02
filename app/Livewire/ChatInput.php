<?php
namespace App\Livewire;

use Livewire\Component;
use App\Services\NgramService;
use Livewire\Attributes\On;

class ChatInput extends Component
{
    public $message = '';
    public $suggestions = [];

    public function updatedMessage($value)
    {
        $words = explode(" ", trim($value));
        if (count($words) > 0 && trim(last($words)) !== '') {
            try {
                $service = new NgramService();

                $this->suggestions = $service->suggestNext(trim($value)); 
            } catch (\Throwable $e) {
                $this->suggestions = [];
            }
        } else {
            $this->suggestions = [];
        }
        // dd($this->suggestions);

        // $this->dispatch('inputUpdated', message: $this->message);
    }

    public function send()
    {
        if (trim($this->message) === '') {
            return;
        }

        $this->dispatch('messageSubmitted', messageContent: $this->message);

        $this->suggestions = [];

        // if ($this->message !== '') {
        //     $this->dispatch('messageSent', message: $this->message);
        //     $this->message = '';
        //     $this->suggestions = [];
        // }
    }
    #[On('clearInput')]
    public function clearInput()
    {
        $this->message = '';
        $this->suggestions = [];
    }

    public function appendSuggestion($word)
    {
        $this->message = trim($this->message) . ' ' . $word . ' ';
        $this->updatedMessage($this->message);
        // $this->suggestions = [];
        $this->dispatch('suggestionAppended');
    }

    public function render()
    {
        return view('livewire.chat-input');
    }
}
