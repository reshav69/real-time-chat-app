<div class="p-6 space-y-10">

    {{-- My Groups --}}
    <div>
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-2xl font-bold">My Groups</h2>
            <a href="{{ route('groups.create') }}" class="px-4 py-2 bg-indigo-800 text-white rounded-md hover:bg-indigo-700">
                Create New
            </a>
        </div>

        @forelse ($myGroups as $group)
            <div class="flex justify-between items-center rounded-xl p-3 mb-3 bg-zinc-800 hover:outline outline-gray-500">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $group->icon) }}" alt="Group Icon"
                         class="w-12 h-12 rounded-full object-cover">
                    <a href="{{ route('groups.show', ['group' => $group->id]) }}"
                       class="text-lg font-semibold text-indigo-400 hover:underline">
                        {{ $group->name }}
                    </a>
                </div>
                <div class="text-gray-400 text-sm">Options</div>
            </div>
        @empty
            <div class="text-center text-gray-500 p-5">You haven't created any groups yet.</div>
        @endforelse
    </div>

    {{-- Joined Groups --}}
    <div>
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-2xl font-bold">Joined Groups</h2>
        </div>

        @forelse ($joined_groups as $group)
            <div class="flex justify-between items-center rounded-xl p-3 mb-3 bg-zinc-800 hover:outline outline-gray-500">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $group->icon) }}" alt="Group Icon"
                         class="w-12 h-12 rounded-full object-cover">
                    <a href="{{ route('groups.show', ['group' => $group->id]) }}"
                       class="text-lg font-semibold text-indigo-400 hover:underline">
                        {{ $group->name }}
                    </a>
                </div>
                <div class="text-gray-400 text-sm">Options</div>
            </div>
        @empty
            <div class="text-center text-gray-500 p-5">You haven’t joined any groups yet.</div>
        @endforelse
    </div>

    {{-- Explore More Groups --}}
    <div>
        <h2 class="text-2xl font-bold mb-4">Explore More Groups</h2>

        <div class="flex gap-5 overflow-x-auto py-2">
            @forelse ($public_groups as $group)
                <div class="w-48 flex-shrink-0 bg-zinc-800 border border-gray-700 rounded-xl shadow-md p-3 hover:bg-zinc-700 transition">
                    <div class="w-full h-32 overflow-hidden rounded-xl">
                        <img src="{{ asset('storage/' . $group->icon) }}" alt="{{ $group->name }}" 
                            class="w-full h-full object-cover">
                    </div>
                    
                    <h3 class="mt-3 text-lg font-semibold text-white truncate">{{ $group->name }}</h3>
                    <a href="{{ route('groups.show', ['group' => $group->id]) }}" 
                        class="mt-2 inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-1 px-3 rounded-md w-full text-center">
                        <i class="bi bi-eye-fill"></i> Visit
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No public groups available to explore.</p>
            @endforelse
        </div>
    </div>

</div>
