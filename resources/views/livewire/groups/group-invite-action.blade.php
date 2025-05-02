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
    {{-- <p>{{$invitation_status}}</p> --}}
    <div>
        @if ($invitation_status === 'none')
        <button wire:click="sendInvitation" class="bg-blue-500 text-white px-3 py-1 rounded">
            Send invite
        </button>
    
        @elseif ($invitation_status === 'sent')
            <button wire:click="cancelInvitation" class="bg-red-500 text-white px-3 py-1 rounded">
                Cancel Invitation
            </button>

        @elseif ($invitation_status === 'received')
            <button wire:click="acceptInvitation" class="bg-green-500 text-white px-3 py-1 rounded">
                Accept
            </button>
            <button wire:click="rejectInvitation" class="bg-gray-500 text-white px-3 py-1 rounded">
                Reject
            </button>
        @elseif ($invitation_status === 'member')
            <p>Already member</p>
        @endif

    </div>
</div>