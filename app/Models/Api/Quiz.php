<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute(): string
    {

        return URL::to('/'). '/' . $this->attributes['image'];
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'quiz_id');
    }
}
