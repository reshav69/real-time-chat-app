<div class="container">
    <h2>{{ $user->username }}'s Profile</h2>
    <p>{{ $user->bio }}</p>

    @if(auth()->id() !== $user->id)
        <button wire:click="sendFriendRequest">Add Friend</button>
    @else
        <p>Edit Profile?</p>
        <a href="{{ route('profile.edit') }}">Go to Edit page</a>
    @endif
</div>
