<div class="m-2 p-4 rounded-lg h-[86vh] flex flex-col relative shadow bg-white dark:bg-zinc-900">
    
    <!-- Chat Header -->
    <div class="border-b pb-2 mb-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="https://img.icons8.com/?size=256w&id=7tLWAgSNQXZ3&format=png" alt="avatar" class="w-10 h-10 rounded-full object-cover border border-indigo-500">
            <a href="{{ route('profile.show', ['username' => $receiver->username]) }}" class="text-indigo-700 hover:underline text-2xl font-bold">
                {{ $receiver->username }}
            </a>
        </div>
        <span class="text-sm text-green-500">Online</span>
    </div>

    <!-- Messages Scrollable Area -->
    <div id="messages" class="flex-1 overflow-y-auto space-y-4 px-2 mb-20 text-black dark:text-white">

        @foreach ($messages as $msg)
            <div class="flex flex-col
                {{ $msg['sender_id'] === auth()->id() ? 'items-end' : 'items-start' }}">
                
                <div class="max-w-[60%] px-4 py-2 rounded-xl shadow 
                    {{ $msg['sender_id'] === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700' }}">
                    <p class="break-words text-sm leading-relaxed">
                        {{ $msg['message'] }}
                    </p>
                </div>

                <small class="mt-1 text-xs text-gray-500 dark:text-gray-400 px-2">
                    {{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}
                </small>
            </div>
        @endforeach

    </div>

    <!-- Message Input + Suggestions -->
    <form wire:submit.prevent="sendMessage"
    class="absolute bottom-4 left-0 w-full px-6 flex items-center space-x-4">
        <!-- Suggestions -->
        @if ($suggestions)
        <div class="absolute top-10 left-0 flex flex-wrap gap-2 p-2 bg-white dark:bg-zinc-700 rounded-xl shadow-md z-20">
            @foreach ($suggestions as $word)
                <span
                    data-word="{{ $word }}"
                    class="cursor-pointer suggestion bg-gray-700 text-white text-xs px-3 py-1 rounded-full hover:bg-indigo-600 transition"
                >
                    {{ $word }}
                </span>
            @endforeach
        </div>
        @endif

        <div class="relative flex-1">
            <x-input
                wire:model.live.debounce.400ms="message"
                id="message"
                name="message"
                type="text"
                placeholder="Type your message..."
                class="w-full"
                autocomplete="off"
                list="chat"
            />

            
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-md">
            <i class="bi bi-send"></i> Send
        </button>
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
        
        let messagesDiv = document.getElementById('messages');
        setTimeout(() => {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }, 50);
        // messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
</script>
@endscript
