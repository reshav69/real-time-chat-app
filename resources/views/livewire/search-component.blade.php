<div>

    <x-input type="text" name="search" wire:model.live.debounce.300ms="search"
    placeholder="Search" class="w-full" autocomplete="off"/>

    <div class="mt-1">
        @if ($search!='')

            @if ($users->count())
                <div class="p-1">
                    <h4 class="text-gray-500 text-sm mb-1">Users</h4>
                    @foreach ($users as $user)
                        <a href="{{ route('profile.show', ['username' => $user->username]) }}" 
                           class="block mb-2 border w-auto p-2 hover:bg-gray-900">
                            {{ $user->username }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($groups->count())
                <div class="p-1">
                    <h4 class="text-gray-500 text-sm mb-1">Groups</h4>
                    @foreach ($groups as $group)
                        <a href="{{ route('groups.show', ['group' => $group->id]) }}" 
                           class="block mb-2 border w-auto p-2 hover:bg-gray-900">
                            {{ $group->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($users->count() === 0 && $groups->count() === 0)
                <div class="p-4 text-gray-400 text-center">
                    No results found.
                </div>
            @endif

            
            {{-- @forelse ($users as $user)
            
                <a class="block mb-2 border w-auto p-2 hover:bg-gray-900" href="{{ route('profile.show',['username'=>$user->username]) }}">
                    {{$user->username}}
                </a>

            @empty
                <p>no results</p>
            @endforelse --}}
            
        @endif

    </div>
</div>
