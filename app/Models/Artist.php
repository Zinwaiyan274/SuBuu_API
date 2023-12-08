<?php

namespace App\Models;

use App\Models\Audio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'image', 'artist_name', 'status', 'audio_count'
    ];

    public function audio(){
        return $this->hasMany(Audio::class);
    }
}
