
<form wire:submit.prevent="send" class="w-full flex h-10 gap-3 relative"> {{-- Added relative for absolute suggestions --}}

    @if ($suggestions)
        <div class="absolute bottom-full left-0 flex flex-wrap gap-2 p-2 mb-2 bg-white dark:bg-zinc-700 rounded-xl shadow-md z-20">
            @foreach ($suggestions as $suggestion)
                <span wire:click="appendSuggestion('{{ $suggestion['word'] }}')"
                    class="cursor-pointer bg-gray-700 text-white text-xs px-3 py-1 rounded-full hover:bg-indigo-600 transition">
                    {{ $suggestion['word'] }}
                </span>
            @endforeach
        </div>
    @endif

    <x-input
            wire:model.live.debounce.200ms="message"
            id="message-input"
            name="message"
            type="text"
            placeholder="Type your message..."
            class="w-full flex-1" 
            autocomplete="off"
        />


    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-md">
        <i class="bi bi-send"></i>
    </button>
</form>


@script
<script>
    Livewire.on('suggestionAppended', () => {
        const input = document.getElementById('message-input');
        if (input) {
            input.focus();
            // Move cursor to the end
            input.setSelectionRange(input.value.length, input.value.length);
        }
    });
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
    })
</script>
@endscript
