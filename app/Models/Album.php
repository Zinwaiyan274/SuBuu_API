<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'album_name', 'song_list', 'status'
    ];

    // public function setSongAttribue($song_list)
    // {
    //     $this->attributes['song_list'] = json_encode($song_list);
    // }

    // public function getSongAttribue($song_list)
    // {
    //     $this->attributes['song_list'] = json_decode($song_list);
    // }
}
