<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Currency;
use App\Models\CurrencyConvert;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\Reward;
use App\Models\Settings;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function publishStatus(Request $request)
    {
        if ($request->ajax()) {

            $statusLastText = explode(" ", $request->statustext);
            switch ($request->statustext) {
                case 'User '.end($statusLastText) :
                   $test= User::class;
                    break;
                case 'Quiz Category '.end($statusLastText):
                   $test= QuizCategory::class;
                    break;
                case 'Quiz '.end($statusLastText):
                   $test= Quiz::class;
                    break;
                case 'Question '.end($statusLastText):
                   $test= Question::class;
                    break;
                case 'Method '.end($statusLastText):
                   $test= WithdrawMethod::class;
                    break;
                case 'Withdraw Request '.end($statusLastText);
                   $test= WithdrawRequest::class;
                    break;
                case 'Currency '.end($statusLastText);
                   $test= Currency::class;
                    break;
                case 'Setting '.end($statusLastText);
                   $test= Settings::class;
                    break;
                case 'Currency Convert '.end($statusLastText);
                   $test= CurrencyConvert::class;
                    break;
               case end($statusLastText);
                   $test= Reward::class;
                    break;
            }
            $test::where('id',$request->id)->update(['status'=>$request->status]);
            return $request;
        }
    }

    public function withdrawApproved($id)
    {
        $withdraw = WithdrawRequest::find($id);
        $withdraw->update([
            'approve_status' => 3,
        ]);

        return response()->json([
            'redirect' => route('withdraw-request'),
            'message' => __('Withdraw approved successfully.')
        ]);
    }

    public function withdrawReject(Request $request, $id)
    {
        $withdraw = WithdrawRequest::find($id);
        Wallet::addBalancePoint($withdraw->user_id, $withdraw->coins);
        $withdraw->update([
            'notes' => $request->notes,
            'approve_status' => 0,
        ]);

        return response()->json([
            'redirect' => route('withdraw-request'),
            'message' => __('Withdraw rejected successfully.')
        ]);
    }
}
