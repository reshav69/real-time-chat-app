<?php

namespace App\Http\Controllers;
use App\Services\NgramService;
use Illuminate\Http\Request;

class NgramController extends Controller
{
    public function suggest(Request $request, NgramService $ngramService)
    {
        $text = "The girl bought a chocolate The boy ate the chocolate The girl bought a toy The girl played with the toy The girl is here The girl is going home";
        
        $ngramService = new NgramService($text);

        $ngramService->setVocab();
        $ngramService->generateBiTrigram();

        $suggestions = $ngramService->suggestNext($request->input('query'));

        return response()->json($suggestions);
    }
}
