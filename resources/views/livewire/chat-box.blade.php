{{-- 
<div class="m-5 p-4 border rounded h-full">
    
    <h2 class="font-bold underline text-xl mb-4">
        <a href="{{ route('profile.show',['username'=>$receiver->username]) }}">Peter</a>
        <div class="fixed bottom-0">


            <form action="" class="flex">
                
                <x-input type="text" name="message" placeholder="chatting message" class="w-full"/>
                <button class="">send</button>
            </form>
        </div> 
    </h2>

</div> --}}
<div class="m-5 p-4 border rounded h-[80vh] flex flex-col relative shadow">

    <!-- Chat Header -->
    <div class="border-b pb-2 mb-2 flex justify-between items-center">
        <h2 class="font-bold text-xl">
            <a href="{{ route('profile.show',['username'=>$receiver->username]) }}" class="text-indigo-600 hover:underline">
                {{ $receiver->username }}
            </a>
        </h2>
        <span class="text-sm text-gray-500">Online</span> {{-- Optional Status --}}
    </div>

    <!-- Messages Scrollable Area -->
    <div class="flex-1 overflow-y-auto space-y-2 pr-2" id="messages">
        {{-- Loop over messages here --}}
        @foreach ($messages as $msg)
            <div class="max-w-[70%] p-2 rounded 
                {{ $msg->sender_id === auth()->id() ? 'bg-blue-500 text-white self-end' : 'bg-gray-200 self-start' }}">
                {{ $msg->message }}
            </div>
        @endforeach
    </div>

    <!-- Message Input -->

    <form wire:submit.prevent="sendMessage" class="w-full flex items-center justify-between">
        <x-input wire:model.defer="newMessage" name="message" type="text"
         placeholder="Type your message..." class="w-2xl"/>
        <button type="submit" class="bg-indigo-600 text-white w-[100px] px-5 py-1 rounded hover:bg-indigo-700">Send</button>
    </form>
</div>




