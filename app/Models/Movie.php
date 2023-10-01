<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovieCategory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'url' , 'thumbnail' , 'category_id'
    ];

    public function movieCategory()
    {
        return $this->belongsTo(MovieCategory::class , 'category_id');
    }

}
