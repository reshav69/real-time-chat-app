<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class GroupInvitation extends Model
{
    //
    use HasFactory;

    protected $fillable=[
        'status',
        'invited_user_id',
        'invited_by_user_id',
        'group_id'
    ];


    public function invitedUser(){
        return $this->belongsTo(User::class,'invited_user_id');
    }

    public function invitedByUser(){
        return $this->belongsTo(User::class,'invited_by_user_id');
    }
    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }

}
