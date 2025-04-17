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
    <p>{{$request_status}}</p>
    <div>
        @if ($request_status === 'none')
        <button wire:click="sendRequest" class="bg-blue-500 text-white px-3 py-1 rounded">
            Add Friend
        </button>
    
        @elseif ($request_status === 'sent')
            <button wire:click="cancelRequest" class="bg-red-500 text-white px-3 py-1 rounded">
                Cancel Request
            </button>

        @elseif ($request_status === 'received')
            <button wire:click="acceptRequest" class="bg-green-500 text-white px-3 py-1 rounded">
                Accept
            </button>
            <button wire:click="rejectRequest" class="bg-gray-500 text-white px-3 py-1 rounded">
                Reject
            </button>
        @elseif ($request_status === 'friends')
            <p>Already Friends</p>
        @endif

    </div>
</div>