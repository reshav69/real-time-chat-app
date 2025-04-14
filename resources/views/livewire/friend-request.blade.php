<div>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div>
        @if (!$request_sent)
            <button wire:click="sendRequest" class="bg-blue-500 text-white px-3 py-1 rounded">
                Add Friend</button>
            
        @else
            <button wire:click="cancelRequest" class="bg-red-500 text-white px-3 py-1 rounded">
                Cancel Request</button>
        @endif
    </div>
</div>