<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'category_name',
        'created_by',
    ];

    // Relasi: Category dimiliki oleh User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'username');
    }

    // Relasi: Category punya banyak Video
    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id', 'category_id');
    }
}
