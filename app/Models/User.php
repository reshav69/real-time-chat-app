<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }
    
    public function befriendedBy()
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members');

    }

    public function sentGroupInvitations()
    {
        // 'invited_by_user_id'
        return $this->hasMany(GroupInvitation::class, 'invited_by_user_id');
    }

    public function receivedGroupInvitations()
    {
        //'invited_user_id'
        return $this->hasMany(GroupInvitation::class, 'invited_user_id');
    }

    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image) {
            // dd($this->profile_image);
            return asset('storage/'.$this->profile_image); 
            // return Storage::disk('public')->url($this->profile_image);
        }

        return asset('storage/user-pics/default.png'); 
    }

}