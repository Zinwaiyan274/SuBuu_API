<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable =['category_id'];

    public function productCategory()
    {
        return $this->belongsTo(ProductType::class,'category_id');
    }

}
