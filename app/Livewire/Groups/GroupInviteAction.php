<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupInviteAction extends Component
{
    public $invitation_status = '';
    public $sender_id;
    public $receiver_id;
    public $invite_id;
    public $invitedGroup;

    public function mount($receiver_id,$invitedGroup,$invite_id = null){
        $this->sender_id = Auth::id();
        $this->receiver_id = $receiver_id;
        $this->invitedGroup = $invitedGroup;
        $this->invite_id = $invite_id;

        $this->invitation_status = $this->checkInvitationStatus();

    }

    public function checkInvitationStatus()
    {
        $invitation = GroupInvitation::where('group_id', $this->invitedGroup->id)
            ->where(function ($query) {
                $query->where('invited_user_id', $this->receiver_id)
                    ->orWhere('invited_by_user_id', $this->receiver_id);
            })->first();

        if (!$invitation) {
            return 'none';
        }

        if ($invitation->status === 'pending') {
            return $invitation->invited_user_id == $this->sender_id ? 'received' : 'sent';
        }
        $isMember = GroupMember::where('group_id', $this->invitedGroup->id)
        ->where('user_id', $this->receiver_id)
        ->exists();

        if ($isMember) {
        return 'member';
        }

        // if ($invitation->status === 'accepted') {
        //     return 'sent';
        // }

        return 'none';
    }

    public function checkinvite(){
        $invitation = GroupInvitation::where('group_id', $this->invitedGroup->id)
            ->where(function ($query) {
                $query->where('invited_user_id', $this->receiver_id)
                    ->orWhere('invited_by_user_id', $this->receiver_id);
            })->exists();

            return $invitation;
    }

    public function sendInvitation(){
        if($this->checkinvite()){
            session()->flash('error', 'Invitation already exists.');
            return;
        }
            

        GroupInvitation::create([
            'group_id' => $this->invitedGroup->id,
            'invited_user_id' => $this->receiver_id,
            'invited_by_user_id' => $this->sender_id,
        ]);
    
        $this->invitation_status = 'sent';
    }

    public function cancelInvitation(){
        if($this->checkInvite()){
            $invitation = GroupInvitation::where('group_id', $this->invitedGroup->id)
            ->where(function ($query) {
                $query->where('invited_user_id', $this->receiver_id)
                    ->orWhere('invited_by_user_id', $this->receiver_id);
            })->first();
                // dd($invitation);
                $invitation->delete();
                $this->invitation_status = 'none';

                session()->flash('success', 'Invitation canceled.');
            return;
        }
        session()->flash('error', 'Invitation cancel failed.');
        $this->invitation_status = 'none';
    }

    public function acceptInvitation(){
        GroupMember::create([
            'group_id'=>$this->invitedGroup->id,
            'user_id'=>$this->receiver_id
        ]);

        GroupInvitation::where('id', $this->invite_id)
        ->delete();

        $this->invitation_status = '';
    }

    public function rejectInvitation(){
        GroupInvitation::where('id', $this->invite_id)
        ->delete();
        $this->invitation_status = '';
    }


    public function render()
    {
        return view('livewire.groups.group-invite-action');
    }
}
