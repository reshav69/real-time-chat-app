<div class="container mx-auto">
    <h2 class="text-3xl mb-4 text-center text-bold" >{{ $user->username }}</h2>
    <hr class="w-[70%] mx-auto ">

    <div class="m-5 p-4 bg-neutral-700 rounded-xl">
        <p class="font-bold m-2">Description</p>
        <p>&emsp;{{($user->bio)? $user->bio :"bio is empty"}}</p>

    </div>


    @if(auth()->id() !== $user->id)
        @livewire('friend-request', ['receiver_id' => $user->id])
    @else
        <a href="{{ route('profile.edit') }}">Edit Profile?</a>
    @endif
</div>
