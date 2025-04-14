<div class="container">
    <h2>{{ $user->username }}'s Profile</h2>
    <p>{{ $user->bio }}</p>

    @if(auth()->id() !== $user->id)
        @livewire('friend-request', ['receiver_id' => $user->id])
    @else
        <a href="{{ route('profile.edit') }}">Edit Profile?</a>
    @endif
</div>
