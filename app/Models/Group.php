<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
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

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id')
                    ->withPivot('role', 'created_at') 
                    ->withTimestamps();
    }

     public function getIconUrlAttribute(): ?string
     {
         if ($this->icon) {
            return asset('storage/'.$this->icon);
         }
         return asset('storage/group-icons/default-group-icon.png');
     }
}
