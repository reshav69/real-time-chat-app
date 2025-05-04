<div class="m-2 p-4 rounded-lg h-[86vh] flex flex-col relative shadow bg-white dark:bg-zinc-900">
    
    <!-- Chat Header -->
    <div class="border-b pb-2 mb-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="{{ asset($group->icon_url) }}" alt="group image" class="w-10 h-10 rounded-full object-cover border border-indigo-500">
            <a href="{{ route('groups.show', ['group' => $group->id]) }}" class="text-indigo-700 hover:underline text-2xl font-bold">
                {{ $group->name }}
            </a>
        </div>
    </div>


    <!-- Messages Scrollable Area -->
    <div id="messages" class="flex-1 overflow-y-auto space-y-4 px-2 mb-10 text-black dark:text-white">

        @foreach ($messages as $msg)
        {{-- @dd($msg) --}}
            <div class="flex flex-col
                {{ $msg['sender_id'] === auth()->id() ? 'items-end' : 'items-start' }}"
            >
                <small class="mt-1 text-xs text-gray-500 dark:text-gray-400 px-2">
                   {{ $msg['sender']['username']}}
                </small>
                
                <div class="max-w-[60%] px-4 py-2 rounded-xl shadow 
                    {{ $msg['sender_id'] === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700' }}">
                    {{-- <img src="{{ $msg['sender']['profile_image'] }}" width="28px" alt="" srcset=""> --}}
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
        <livewire:chat-input />

    
</div>


@script
<script>

    Livewire.on('scrollToBottom', () => {
        
        let messagesDiv = document.getElementById('messages');
        setTimeout(() => {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }, 50);
        // messagesDiv.scrollTop = messagesDiv.scrollHeight;
    })
</script>
@endscript