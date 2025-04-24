<div class="container mx-auto">
    <div class="text-center">
        <h2 class="text-3xl mb-3 text-center text-bold" >{{ $user->username }}</h2>
        <p class="text-sm m-1">joined on <i>{{$user->created_at}}</i></p>

    </div>
    <hr class="w-[70%] mx-auto ">

    <div class="m-5 p-4 bg-neutral-700 rounded-xl flex items-center">

        <div class="border h-fit min-w-[200px] flex">
            <img src="" alt="" width="200">

        </div>
        <div class="w-full">
            <p class="font-bold m-2 border-b ">Description</p>
            <p class="break-normal ml-5">{{($user->bio)? $user->bio :"bio is empty"}}</p>

        </div>

    </div>

    <div class="p-4">
        @if(auth()->id() !== $user->id)
            @livewire('friend-request', ['receiver_id' => $user->id])
        @else
            <a href="{{ route('profile.edit') }}">Edit Profile?</a>
        @endif

    </div>
</div>
