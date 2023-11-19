<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\TableSection;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id' , 'type_id' , 'data'];

    protected $casts = ['data' => 'array'];

    public function type()
    {
        return $this->hasOne(NotificationType::class , 'id' , 'type_id');
    }

}
