<div>

    <x-input type="text" name="search" wire:model.live.debounce.300ms="search"
    placeholder="search" class="w-full" autocomplete="off"/>

    <div>
        @if ($search!='')
            @forelse ($users as $user)
                <a class="mb-2 border" href="{{ route('profile.show',['username'=>$user->username]) }}">{{$user->username}}</a>
            @empty
                <p>no results</p>
            @endforelse
            
        @endif

    </div>
</div>
