<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class point extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'user_id', 'total_point', 'withdrawed_point' ];
}
