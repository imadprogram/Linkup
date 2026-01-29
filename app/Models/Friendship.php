<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * We need to whitelist these 3 columns so we can create friendships easily.
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
    ];

    /**
     * Relationship: Who sent the request?
     * It belongs to a User, using the 'sender_id' column.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relationship: Who received the request?
     * It belongs to a User, using the 'receiver_id' column.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
