<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\NgramService;
class Dashboard extends Component
{   


    public $user;

    public function benchmark(){
        $ngramService =new NgramService();
        $startTime = microtime(true);  // Get the start time

    // Call your original suggestNext() method (before optimization)
        $result = $ngramService->suggestNext("i am a big fan of");

        $endTime = microtime(true);  // Get the end time

        $executionTimeOriginal = $endTime - $startTime;  // Calculate execution time in seconds

        echo 'Original Execution Time: ' . $executionTimeOriginal . ' seconds';
        dd($result);
    }

    public function mount(){
        // $this->user = User::where('username',Auth::user)->firstOrFail();
        $this->user = Auth::user();

        // $this->benchmark();
    }
    public function render()
    {
        view()->share('title', 'Dashboard');
        return view('livewire.auth.dashboard');
    }
}
