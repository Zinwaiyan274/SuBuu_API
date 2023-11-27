<?php

namespace App\Models;

use App\Models\Artist;
use App\Models\AudioLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'image', 'audio', 'audio_title', 'artist_id', 'status'];

    public function artist(){
        return $this->belongsTo(Artist::class);
    }

    public function audioLike(){
        return $this->hasMany(AudioLike::class);
    }

}
