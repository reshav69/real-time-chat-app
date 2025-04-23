<div class="container mx-auto">
    <h2 class="text-3xl mb-5 text-center text-bold" >{{ $user->username }}'s Profile</h2>
    <hr class="w-[70%] mx-auto ">
    <p>Description: {{ $user->bio }}</p>

    @if(auth()->id() !== $user->id)
        @livewire('friend-request', ['receiver_id' => $user->id])
    @else
        <a href="{{ route('profile.edit') }}">Edit Profile?</a>
    @endif
</div>
