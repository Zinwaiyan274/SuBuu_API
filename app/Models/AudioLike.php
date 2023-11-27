<?php

namespace App\Models;

use App\Models\User;
use App\Models\Audio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AudioLike extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'audio_id', 'like'];

    public function audio(){
        return $this->belongsTo(Audio::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
