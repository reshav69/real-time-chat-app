<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Group;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log;
// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel('chat.{receiverId}', function ($user, $receiverId) {
//     return (int) $user->id === (int) $receiverId;
// });

Broadcast::channel('chat-channel.{userId}', function(User $user, $userId){
    return (int) $user->id === (int) $userId;
});


Broadcast::channel('group.{groupId}', function ($user, $groupId) {
    Log::info("Auth Check: User ID " . ($user ? $user->id : 'null') . " attempting to join channel group.{$groupId}");
    $group = Group::find($groupId);
    $isMember = ($user && $group && $group->users->contains($user->id));
    Log::info("Auth Check Result: User ID " . ($user ? $user->id : 'null') . " for group.{$groupId} - " . ($isMember ? "AUTHORIZED" : "DENIED"));
    return $isMember;
});
