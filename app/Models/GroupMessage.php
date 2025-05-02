<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class GroupMessage extends Model
{
    use HasFactory;

     protected $fillable = [
        'group_id',
        'sender_id',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
