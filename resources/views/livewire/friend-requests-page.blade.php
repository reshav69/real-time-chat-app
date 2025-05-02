<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Received Friend Requests</h2>
    @forelse ($receivedRequests as $req)
        <div class="mb-2 border p-2 rounded">
            
            <p>
                <a class="font-bold"
                 href="{{ route('profile.show',['username'=>$req->sender->username]) }}">
                {{ $req->sender->username }}</a> wants to be your friend
            </p>
            <!-- Accept/Reject buttons here -->
            @livewire('friend-request', ['receiver_id' => $req->sender->id,'requestId' => $req->id,], key($req->id))
        </div>
    @empty
        <p>No incoming requests.</p>
    @endforelse

    <h2 class="text-xl font-bold mt-6 mb-4">Sent Friend Requests</h2>
    @forelse ($sentRequests as $req)
        <div class="flex w-fit mb-2 border p-2 rounded">
            <p>You sent a request to
            <a href="{{ route('profile.show',['username'=>$req->receiver->username]) }}">
                {{ $req->receiver->username }}

            </a>
            </p>
            @livewire('friend-request', ['receiver_id' => $req->receiver->id,'requestId' => $req->id,], key($req->id))
        </div>
    @empty
        <p>No sent requests.</p>
    @endforelse
        <hr class="m-5">
    <div>
        <livewire:groups.group-invitation-page/>

    </div>
</div>