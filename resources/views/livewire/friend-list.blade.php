<div>
    @foreach ($friends as $friend)

        <div class="p-2 mr-10 ml-10 mx-auto flex justify-between border-b border-sky-800 mb-4 hover:bg-gray-800 rounded-xl">
            <div class="flex">
                {{-- {{ $friend->friend->username }} --}}
                <span class="mr-4 border-r border-gray-600 p-1">
                    <img src="https://img.icons8.com/?size=256w&id=7tLWAgSNQXZ3&format=png" alt="avatar" width="30px">
                </span>
                <a href="{{ route('profile.show',['username'=>$friend->friend->username] )}}">
                    {{ $friend->friend->username }}</a>

            </div>
            <div>
                <a href="{{ route('chat.show', ['username' => $friend->friend->username]) }}"
                    class="mx-auto rounded ">
                    <img src="chat-icon.png" alt="chat-icon" width="34px" class="rounded-xl p-1 hover:bg-indigo-500 hover:text-white transition-all">
                </a>

            </div>

        </div>
        
        
    @endforeach
</div>
