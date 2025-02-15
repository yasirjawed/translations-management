<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Translation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'locale',
        'key',
        'content',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

}
