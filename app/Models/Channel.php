<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;

    protected $primaryKey = 'channel_id';

    protected $fillable = [
        'channel_name',
        'channel_url',
        'created_by',
    ];

    // Relasi ke User (creator)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'username');
    }

    // Relasi ke Video
    public function videos()
    {
        return $this->hasMany(Video::class, 'channel_id', 'channel_id');
    }

}
