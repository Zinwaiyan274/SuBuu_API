<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    private $pointNotiId = 1;
    private $balanceNotiId = 2;

    public function getPointNotifications()
    {
        $userId = Auth::user()->id;
        
        $notification = Notification::with('type')->where([
            [ 'user_id' , $userId ],
            [ 'type_id' , $this->pointNotiId ]
        ])->get();

        return response()->json($notification , 200);
    }

    public function getNotifications() 
    {
        $userId = Auth::user()->id;

        $notifications = Notification::with('type')->where('user_id' , $userId)->get();

        return response()->json($notifications, 200); 
    }

}
