<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PostBackController extends Controller
{
    public function maanPostBack( Request $request){
        return $request;
        $this->user = User::find($id);
        $amount = isset($this->user) ? $amount : '';
        $this->user->balance = $this->user->balance + $amount;
        $this->user->save();
    }
}
