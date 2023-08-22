<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class QuizCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute(): string
    {

        return URL::to('/'). '/' . $this->attributes['image'];
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class,'category_id');
    }
}
