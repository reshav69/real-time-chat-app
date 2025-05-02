<div class="m-5 p-6 border border-gray-500 rounded-lg shadow space-y-6">
    <!-- Group Header -->
    <div class="border-b border-gray-500 pb-4 w-full">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-2">{{ $group->name }}</h1>


            @if ($isMember)
            <div>

                <a href="{{ route('groups.chat',['group'=>$group->id]) }}" class="p-2 bg-sky-600 rounded mr-3">Chat</a>
                    
                <button wire:click="toggleInviteForm" class="bg-green-600 hover:bg-green-700 p-2 rounded">
                    <i class="bi bi-plus-circle-dotted"></i> Invite Members
                </button>
            </div>
            @endif

        </div>
        <hr class="m-5 text-gray-500">
        <div class="flex bg-neutral-800 p-2 rounded-2xl shadow">
            <div>
                @if ($group->icon)
                    <img src="{{ asset('storage/' . $group->icon) }}" 
                         alt="{{ $group->name }} Icon" 
                         class="w-46 h-46 object-cover rounded-full mb-4">
                @endif

                <div class="text-sm space-y-1">
                    <p>Type: <span class="capitalize font-bold">{{ $group->type }}</span></p>
                    <p>Admin: <span class="italic font-bold">{{ $group->admin->username }}</span></p>
                    <p>Created At: <span class="italic font-bold">{{$group->created_at}}</span></p>
                </div>
            </div>
            
            <div class="ml-5">
                <p class="border-b border-gray-500 p-1 mb-4">Description:</p>
                <p class="ml-2 break-normal">{{ $group->description }}</p>
            </div>

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
                       <i class="bi bi-pencil-fill"></i> Edit Group
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
        <h2 class="text-2xl font-semibold mb-3">Members ({{ $group->members->count() }})</h2>
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
    @if ($showInviteForm)
        <livewire:groups.group-invite :group="$group" />
    @endif
</div>
