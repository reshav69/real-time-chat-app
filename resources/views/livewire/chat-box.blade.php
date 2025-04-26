<div class="m-5 p-4 rounded h-[86vh] flex flex-col relative shadow ">

    <!-- Chat Header -->
    <div class="border-b pb-2 mb-2 flex justify-between items-center">
        <h2 class="font-bold text-xl">
            <a href="{{ route('profile.show',['username'=>$receiver->username]) }}" class="text-indigo-600 hover:underline">
                {{ $receiver->username }}
            </a>
        </h2>
        <span class="text-sm text-gray-500">Online</span>
    </div>


    <!-- Messages Scrollable Area -->
    <div class="flex-1 overflow-y-auto space-y-2 pr-2 text-black mb-7" id="messages">

        @foreach ($messages as $msg)
        {{-- @dd($messages) --}}
            <div class="w-auto max-w-88  py-1 px-3 rounded-3xl border ml-5 mr-5

                {{ $msg['sender_id'] === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-300' }}
                {{ $msg['sender_id'] === auth()->id() ? 'ml-auto text-right' : 'mr-auto text-left' }}">
    
                {{-- Display message content --}}
                <p class="mt-1 break-words">

                    {{ $msg['message'] }}
                </p>
    
                {{-- Optional: Display timestamp (created_at is available) --}}
                <small class="mr-3 block text-xs
                 {{ $msg['sender_id'] === auth()->id() ? 'text-blue-300 text-left' : 'text-right text-gray-500' }}">
                  {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}</small>
            </div>
        @endforeach
    </div>
    {{-- <div id="lastMessage"></div> --}}



    <!-- Message Input -->
    
    <form wire:submit.prevent="sendMessage" class="w-full flex items-center justify-between">
        <x-input wire:model.live.debounce.400ms="message" id="message" name="message" type="text"
        placeholder="Type your message..." class="min-w-[50vw] w-auto" autocomplete="off" list="chat"/>
        
        <button type="submit" class="bg-indigo-600 text-white w-[100px] px-5 py-1 rounded hover:bg-indigo-700">Send</button>
        @if ($suggestions)
        <div class="absolute space-x-2 mb-25 rounded-full rounded shadow-md">
                @foreach ($suggestions as $word)
                    {{-- @dd($word) --}}
                    <span data-word="{{ $word }}" class="cursor-pointer suggestion bg-gray-700 text-sm rounded-3xl p-2">
                        {{ ($word) }}</span>
    
                @endforeach
            </div>
                @endif
    </form>


</div>

@script
<script>


    document.addEventListener('click', function (event) {
            console.log("clicks");
            const clickedElement = event.target;
            // console.log(clickedElement);

            if (clickedElement.classList.contains('suggestion')) {
                // console.log("clicks on");
                const word = clickedElement.getAttribute('data-word');
                const input = document.getElementById('message');
                // console.log

                if (input) {
                    const current = input.value.trim();
                    input.value = current ? current + ' ' + word : word;
                    input.dispatchEvent(new Event('input'));
                }
            }
        });


    Livewire.on('scrollToBottom', () => {
        
        let messagesDiv = document.querySelector('#messages');
        setTimeout(() => {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }, 50);
        // messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
</script>
@endscript