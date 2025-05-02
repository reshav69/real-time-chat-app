<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
class Group extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'icon',
        'description',
        'type',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id');
    }

    public function invitations()
    {
        return $this->hasMany(GroupInvitation::class, 'group_id');
    }

}
