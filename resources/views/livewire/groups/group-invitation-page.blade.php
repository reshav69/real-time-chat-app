<div>
    <div>
        <p class="font-bold text-xl p-2 m-2">Received Invitations</p>

        @forelse ($receivedInvitations as $invs)
        <div class="flex justify-between w-full mb-2 border border-gray-500 hover:bg-gray-800 p-2 rounded">
            <p>
            <a class="font-bold" href="{{ route('profile.show',['username'=>$invs->invitedByUser->username]) }}">
                {{ $invs->invitedByUser->username}}
            </a>
            
            invited you to join 
            <a class="font-bold" href="{{ route('groups.show',['group'=>$invs->group->id]) }}">
                {{ $invs->group->name}}
            </a>
            </p>

            <div class="">
                @livewire('groups.group-invite-action', [
                    'receiver_id' => auth()->id(),
                    'invitedGroup' => $invs->group,
                    'invite_id' => $invs->id
                ], key('invite-action-received-' . $invs->id))
                {{-- <p class="hover:bg-green-700 bg-green-600 rounded-full px-1 text-2xl"><i class="bi bi-check "></i></p>
                <p class="hover:bg-red-700 bg-red-600 rounded-full px-1 text-2xl"><i class="bi bi-x "></i></p> --}}
            </div>
        </div>
            
        @empty
            <p>You havenot invited anyone</p>
        @endforelse
    </div>
      
    <div>
        <p class="font-bold text-xl p-2 m-2">Sent Invitations</p>
        @forelse ($sentInvitations as $invs)
            
        <div class="flex justify-between w-full mb-2 border border-gray-500 hover:bg-gray-800 p-3 rounded">
            <p>You invited
            <a class="font-bold" href="{{ route('profile.show',['username'=>$invs->invitedUser->username]) }}">
                {{ $invs->invitedUser->username}}

            </a>
            to join 
            <a class="font-bold" href="{{ route('groups.show',['group'=>$invs->group->id]) }}">
                {{ $invs->group->name}}
            </a>
            </p>
            <div>
                @livewire('groups.group-invite-action', [
                    'receiver_id' => $invs->invited_user_id,
                    'invitedGroup' => $invs->group,
                    'invite_id' => $invs->id
                ], key('invite-action-sent-' . $invs->id))
            </div>
            
        </div>
        @empty
            <p>No one has invited you</p>
        @endforelse
    </div>
</div>
