<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $message =[
        //response success ..
        [
            'message'=>'Response Successfully!',
            'alert-type'=>'success'
        ],
        //created ..
        [
            'message'=>'Data Created Successfully!',
            'alert-type'=>'success'
        ],
        // data found ..
        [
            'message'=>'Get Data Successfully!',
            'alert-type'=>'success'
        ],
            //  data updated ..
        [
            'message'=>'Data Updated Successfully!',
            'alert-type'=>'success'
        ],
            //  validator ..
        [
            'message'=>'Sorry!!Data validation Failed!',
            'alert-type'=>'error'
        ],
            //  bad request ..
        [
            'message'=>'Sorry!! You\'ar Send Bad Request!',
            'alert-type'=>'error'
        ],
            //  data not found ..
        [
            'message'=>'Sorry!! Data Not Found!',
            'alert-type'=>'error'
        ],
            //  data already exist ..
        [
            'message'=>'Sorry!! Data Already Exists!',
            'alert-type'=>'error'
        ],
            //  unauthorized request ..
        [
            'message'=>'Sorry!! Unauthenticated Request!',
            'alert-type'=>'error'
        ],
            //  time request error ..
        [
            'message'=>'Sorry!! Try After Few Time!',
            'alert-type'=>'error'
        ],
            //  check balance error ..
        [
            'message'=>'Sorry!! Unavailable Balance!',
            'alert-type'=>'error'
        ]
    ];

    protected function setSuccess($message)
    {
        session()->flash('type', 'success');
        session()->flash('message', $message);
    }

    protected function setError($message)
    {
        session()->flash('type', 'warning');
        session()->flash('message', $message);
    }

    protected function setDelete($message)
    {
        session()->flash('type', 'warning');
        session()->flash('delete', $message);
    }

    protected function respondWithValidatorError($message = '', $data = [], $code = 422)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithSuccess($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithCreated($message = '', $data = [], $code = 201)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithFound($message = '', $data = [], $code = 302)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithUpdate($message = '', $data = [], $code = 426)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithError($message = '', $data = [], $code = 400)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithErrorNotFound($message = '', $data = [], $code = 404)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithAlreadyExists($message = '', $data = [], $code = 208)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function respondWithUnauthorized($message = '', $data = [], $code = 401)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }
    protected function respondWithNotAcceptable($message = '', $data = [], $code = 406)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }
    protected function respondWithUnavilableBalance($message = '', $data = [], $code = 451)
    {
        return response()->json([
            'error'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }
}
