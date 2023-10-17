<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'url' , 'thumbnail' ,
    ];

    public function categories()
    {
        return $this->belongsToMany(MovieCategory::class);
    }

}
