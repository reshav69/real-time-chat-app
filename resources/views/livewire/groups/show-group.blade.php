<div class="m-5 p-6 border rounded-lg shadow space-y-6">
    <!-- Group Header -->
    <div class="border-b pb-4">
        <h1 class="text-3xl font-bold mb-2">{{ $group->name }}</h1>
        <hr class="m-5">
        @if ($group->icon)
            <img src="{{ asset('storage/' . $group->icon) }}" 
                 alt="{{ $group->name }} Icon" 
                 class="w-46 h-46 object-cover rounded-full mb-4">
        @endif

        <p class="text-gray-700 mb-2">{{ $group->description }}</p>
        <div class="text-sm text-gray-500 space-y-1">
            <p>Type: <span class="capitalize">{{ $group->type }}</span></p>
            <p>Admin: {{ $group->admin->username }}</p>
        </div>
    </div>

    <!-- Group Actions -->
    @auth
        <div>
            @if ($isAdmin)
                <div class="flex items-center justify-between">
                    <p class="text-red-600 font-semibold">You are the admin of this group.</p>
                    <a href="{{ route('groups.edit', ['group' => $group->id]) }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                        Edit Group
                    </a>
                </div>
            @elseif ($isMember)
                <div class="flex items-center justify-between">
                    <p class="text-green-600 font-semibold">You are a member of this group.</p>
                    <button wire:click="leaveGroup" 
                            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                        Leave Group
                    </button>
                </div>
            @else
                @if ($group->type === 'public')
                    <button wire:click="joinGroup" 
                            class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Join Group
                    </button>
                @else
                    <p class="text-blue-600 font-semibold">This is a private group. Invitation required.</p>
                @endif
            @endif
        </div>
    @else
        <p class="text-gray-500">Please login to join or interact with this group.</p>
    @endauth

    <!-- Group Members -->
    <div>
        <h2 class="text-2xl font-semibold mb-3">Members</h2>
        @if ($group->members->isNotEmpty())
            <ul class="list-disc list-inside space-y-2">
                @foreach ($group->members as $groupMember)
                    <li>
                        <a href="{{ route('profile.show', ['username' => $groupMember->user->username]) }}" 
                           class="text-indigo-600 hover:underline">
                            {{ $groupMember->user->username }}
                        </a> 
                        ({{ $groupMember->role }})
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400">No members yet.</p>
        @endif
    </div>
</div>
