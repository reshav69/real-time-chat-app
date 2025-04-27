<div class="p-5">
    <div class="overflow-y-auto h-[50vh]">
        <div class="flex justify-between border-b p-2">
            <h2 class="text-2xl">My Groups</h2>
            <a class="p-2 bg-indigo-800 text-white rounded" href="{{ route('groups.create') }}">Create New</a>
        </div>
    
        @forelse ($myGroups as $group)
            <div class="flex justify-between border m-3 rounded p-2 items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $group->icon) }}" alt="Group Icon" class="w-12 h-12 rounded-full object-cover">
                    <a href="{{ route('groups.show', ['group' => $group->id]) }}" class="font-bold text-indigo-800">{{ $group->name }}</a>
                </div>
                <div>
                    Options
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 p-5">You haven't created any groups yet.</div>
        @endforelse
    </div>


    <div class="overflow-y-auto h-[50vh]">
        <div class="flex justify-between border-b p-2">
            <h2 class="text-2xl">Joined Groups</h2>

        </div>
        @foreach ($joined_groups as $group)
        <div class="flex justify-between border m-3 rounded p-2 items-center">
            <div class="flex items-center gap-4">
                {{-- {{ $group->icon }} --}}
                <img src="{{ asset('storage/'.$group->icon) }}" alt="Group Icon" class="w-12 h-12 rounded-full object-cover">

                
                <a href="#" class="font-bold text-indigo-800">{{ $group->name }}</a>
            </div>
            <div>
                Options
            </div>
        </div>
        
        @endforeach
    </div>
</div>