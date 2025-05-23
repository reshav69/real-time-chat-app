<div class="container mx-auto">
    <div class="text-center">
        <h2 class="text-3xl mb-3 text-center text-bold" >{{ $user->username }}</h2>
        <p class="text-sm m-1">joined on <i>{{$user->created_at}}</i></p>

    </div>
    <hr class="w-[70%] mx-auto ">

    <div class="m-5 p-4 bg-neutral-800 rounded-xl flex">

        <div class="h-fit min-w-[200px] flex">
            <img src="{{ $user->profile_image_url }}" alt="" width="200">

        </div>
        <div class="w-full">
            <p class="font-bold m-2 border-b ">Description</p>
            <p class="break-normal ml-5">{{($user->bio)? $user->bio :"bio is empty"}}</p>

        </div>

    </div>

    <div class="p-4">
        @if(auth()->id() !== $user->id)
            @livewire('friend.friend-request', ['receiver_id' => $user->id])
            {{-- <a href="{{ route('chat.show',['username'=>$user->username]) }}" class="p-2 bg-blue-500 hover:bg-blue-600 "></a> --}}
        @else
            <a href="{{ route('profile.edit') }}">Edit Profile?</a>
        @endif

    </div>
</div>
