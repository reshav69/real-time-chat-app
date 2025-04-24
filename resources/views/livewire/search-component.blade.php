<div>

    <x-input type="text" name="search" wire:model.live.debounce.300ms="search"
    placeholder="search" class="w-full" autocomplete="off"/>

    <div class="mt-5">
        @if ($search!='')
            @forelse ($users as $user)
            
                <a class="block mb-2 border w-auto p-2 hover:bg-gray-900" href="{{ route('profile.show',['username'=>$user->username]) }}">
                    {{$user->username}}
                </a>

            @empty
                <p>no results</p>
            @endforelse
            
        @endif

    </div>
</div>
