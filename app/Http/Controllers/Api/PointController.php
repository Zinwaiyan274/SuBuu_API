<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Point;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PointController extends Controller
{
    private $dailyPoint = 10;
    /* Get User Point */
    public function getPoint()
    {
        $userId = Auth::user()->id;

        if ($userId) {
            $totalPoint = Point::select('total_point')->where('user_id', $userId)->first();

            return response()->json($totalPoint, 200);
        } else {
            return response()->json([
                'status' => 204,
                'msg' => "There's no data!"
            ]);
        }
    }

    /* Give Point */
    public function givePoint(Request $request)
    {
        $userId = Auth::user()->id;

        $userData = Point::where('user_id', $userId)->first();

        if($userData){
            $data = [
                'total_point' => $userData->total_point + $request->point,
            ];
            $userData->update($data);
        }elseif(!$userData){
            $data = [
                'user_id' => $userId,
                'total_point' => $request->point,
                'withdrawed_point' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            Point::insert($data);

        }

        $notification_type = NotificationType::where("name", "Point")->get();

        $type_id =  $notification_type->first()->id;

        $notification = Notification::create([
            "type_id" => $type_id,
            "user_id" => $userId,
            "data" => [
                "message" => "Point is added!",
                "data" => $totalPoint,
            ],
        ]);

        return response()->json([
            "point" => $totalPoint,
            "notification" => $notification
        ], 200);
    }

    public function getDailyPoint()
    {
        $userId = Auth::user()->id;

        $userPoints = Point::where('user_id', $userId)->first();

        $newTotalPoint = $userPoints->total_point + $this->dailyPoint;

        Point::where('user_id', $userId)->update(['total_point' => $newTotalPoint]);

        return response()->json([
            'message' => 'Daily Point is added to your account'
        ], 200);
    }
}
