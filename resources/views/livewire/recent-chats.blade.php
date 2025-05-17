<div>
    @if ($chats)
    @foreach ($chats as $c)
    <div class="flex flex-col gap-2">
        <a href="{{ $c['link'] }}" class="p-2 bg-gray-700 hover:bg-gray-800 rounded mb-1
            @if ($c['type'] === 'group')
                bg-neutral-800
            @endif
        ">
            {{$c['name']}}
            <p class="text-xs">{{ $c['time'] }}</p>
        </a>

    </div>
    @endforeach
    @else
        <p>Start chatting to see chats</p>
        
    @endif

</div>
