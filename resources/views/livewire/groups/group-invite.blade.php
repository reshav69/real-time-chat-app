<div class="mt-4 h-[70vh] p-4 rounded bg-gray-800 shadow-inner z-100 fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[50vw] m-auto">
    <div class="flex justify-between">
        <h3 class="text-lg font-semibold mb-2">Invite Users to: <i>{{ $group->name }}</i></h3>
        <button wire:click="cancel" type="button" 
        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium hover:bg-red-500">
            Cancel
        </button>

    </div>
    
    <div class="mb-4">
        <label for="search" class="block text-sm font-medium text-gray-700">Search User:</label>
        <input autocomplete="off" type="text" wire:model.live="search" id="search" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter username...">
    </div>

    @if (!empty($searchResults))
        <ul class="border rounded-md mt-1 max-h-40 overflow-y-auto shadow-lg">
            @foreach ($searchResults as $user)
                <li class="px-4 py-2 hover:bg-gray-700">
                    <p>{{ $user->username }}</p>
                    
                    @livewire('groups.group-invite-action', [
                    'receiver_id' => $user->id,
                    'invitedGroup' => $group,
                    ], key($user->id))
                    {{-- @livewire('groups.group-invite-action') --}}
                    {{-- <button wire:click="selectUser({{ $user->id }})" class="rounded">Invite</button> --}}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- @if ($selectedUser)
        <div class="mt-2 p-2 bg-green-800 border border-green-300 rounded-md flex justify-between items-center">
            <span>Selected: <span class="font-semibold">{{ $selectedUser->username }}</span></span>

        </div>
    @endif

    @error('selectedUser') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror --}}

    {{-- <div class="mt-4 flex justify-end space-x-2">

        <button wire:click="sendInvitation" type="button" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
            Send Invitation
        </button>
    </div> --}}
</div>