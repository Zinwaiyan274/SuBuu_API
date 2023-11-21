<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Point;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    /* Get User Point */
    public function getPoint(){
        $userId = Auth::user()->id;

        if($userId){
            $totalPoint = Point::select('total_point')->where('user_id', $userId)->first();

            return response()->json($totalPoint, 200);
        } else{
            return response()->json([
                'status' => 204,
                'msg' => "There's no data!"
            ]);
        }
    }

    /* Give Point */
    public function givePoint(Request $request){
        $userId = Auth::user()->id;

        $userData = Point::where('user_id', $userId)->first();
        // $totalPoint = 0;

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

        $notification = [
            'type_id' => 1,
            'user_id' => $userId,
            'data' => $request->point . " have been added successfully!",
        ];

        Notification::insert($notification);

        return $this->respondWithSuccess('Success.', $userData);
    }
}
