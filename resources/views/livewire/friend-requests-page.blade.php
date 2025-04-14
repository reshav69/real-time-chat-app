<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Received Friend Requests</h2>
    @forelse ($receivedRequests as $req)
        <div class="mb-2 border p-2 rounded">
            <p><strong>{{ $req->sender->username }}</strong> wants to be your friend</p>
            <!-- Accept/Reject buttons here -->
            <button>Accept</button>
            <button>Reject</button>
        </div>
    @empty
        <p>No incoming requests.</p>
    @endforelse

    <h2 class="text-xl font-bold mt-6 mb-4">Sent Friend Requests</h2>
    @forelse ($sentRequests as $req)
        <div class="flex w-fit mb-2 border p-2 rounded">
            <p>You sent a request to <strong>{{ $req->receiver->username }}</strong></p>
            <button class="ml-5 bg-blue-500 hover:bg-blue-700 text-white
             p-1 rounded focus:outline-none focus:shadow-outline ">
            Cancel</button>
        </div>
    @empty
        <p>No sent requests.</p>
    @endforelse
</div>