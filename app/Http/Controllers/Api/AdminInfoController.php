<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adnetwork;
use App\Models\Api\DailyRewards;
use App\Models\Api\Question;
use App\Models\Api\Quiz;
use App\Models\Api\QuizCategory;
use App\Models\Api\UserQuiz;
use App\Models\Api\WithdrawMethod;
use App\Models\CurrencyConvert;
use App\Models\Reward;
use App\Models\UserGain;
use App\Models\Wallet;
use App\Models\Api\WithdrawRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminInfoController extends Controller
{
    public function categoryInfo(): JsonResponse
    {
        $category = QuizCategory::class;
        if ($category::exists()) {
            $data['category_info'] = $category::where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data failed !');
        }
    }
    public function quizInfo(): JsonResponse
    {
        $category = Quiz::class;
        if ($category::exists()) {
            $data['quiz_info'] = $category::where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data failed !');
        }
    }
    public function questionInfo(): JsonResponse
    {
        $category = Question::class;
        if ($category::exists()) {
            $data['question_info'] = $category::where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data failed !');
        }
    }
    public function rewardInfo(): JsonResponse
    {
        $category = Reward::class;
        if ($category::exists()) {
            $data['reward_info'] = $category::where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data failed !');
        }
    }
    public function categoryWiseQuiz(): JsonResponse
    {
        $category = QuizCategory::class;
        if ($category::exists()) {
            $data['category_quiz'] = $category::with('quizzes', 'quizzes.questions')->where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data failed !');
        }
    }

    public function quizByCategory($category_id): JsonResponse
    {
        $category = QuizCategory::class;

        $data['quiz_info'] = $category::with('quizzes', 'quizzes.questions')->where('status', 1)->where('id', $category_id)->get();

        return $this->respondWithSuccess('Get Data Successfully  !', $data);
    }

    public function whitdrawMethod(): JsonResponse
    {
        $method = WithdrawMethod::class;
        if ($method::exists()) {
            $data['withdraw_method'] = $method::where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully !', $data);
        } else {
            return $this->respondWithErrorNotFound('Sorry data not found !');
        }
    }

    public function addPointSpin(Request $request): JsonResponse
    {
        $data = $request->only('description');
        $data['amount'] = $request->coin;
        $data['user_id'] = auth()->user()->id;
        $data['gain_status'] = 'Gain';
        UserGain::create($data);
        Wallet::addBalancePoint(auth()->user()->id, $request->coin);

        return $this->respondWithSuccess('Date added successfully !', $data);
    }

    public function removePointSpin(Request $request)
    {
        $data = $request->only('description');

        $data['amount']         = $request->coin;
        $data['user_id']        = auth()->user()->id;
        $data['gain_status']    = 'Loss';

        $balance = Wallet::where('user_id', auth()->user()->id)->value('balance');
        if ($balance >= 0 && $data['amount'] < $balance) {
            UserGain::create($data);
            Wallet::removeBalancePoint(auth()->user()->id, $request->coin);
            return $this->respondWithSuccess('Date removed successfully !', $data);
        } else {
            return $this->respondWithUnavilableBalance($this->message[10]['message'], $data);
        }
    }

    public function addPointQuiz(Request $request): JsonResponse
    {
        $data               = $request->only('quiz_id', 'win_status', 'result_status');
        $data['amount']     = $request->coin;
        $data['user_id']    = auth()->user()->id;
        if (Quiz::find($request->quiz_id)) {

            $userQuizMod = UserQuiz::class;
            //array 1 ...
            $array1 = array(
                'user_id'   =>  $data['user_id'],
                'quiz_id'   =>  $data['quiz_id']
            );
            //array 2 ...
            $array2 = array(
                'win_status'    =>  '1',
                'result_status' =>  '1'
            );
            if ($userQuizMod::where($array1)->exists()) {
                // existing condition
                $ifExistUserQuiz = $userQuizMod::where($array1);

                if ($ifExistUserQuiz->where($array2)->exists()) {
                    return $this->respondWithAlreadyExists($this->message[7]['message'], $data);
                } else {
                    //$ifExistUserQuiz->get();
                    $userQuizMod::where($array1)->update($data);

                    if ($data['win_status'] == '1' && $data['result_status'] == '1') {
                        // add balance..
                        Wallet::addBalancePoint($data['user_id'], $data['amount']);

                        return $this->respondWithUpdate('Date updated successfully !', $data);
                    } else {
                        return $this->respondWithUpdate('Sorry! You\'re Loss This Quiz !', $data);
                    }
                }
            } else {
                $userQuizMod::create($data);

                if ($data['win_status'] == 1 && $data['result_status'] == 1) {
                    Wallet::addBalancePoint($data['user_id'], $data['amount']);
                }
                return $this->respondWithSuccess('Date added successfully !', $data);
            }
        } else {
            return $this->respondWithErrorNotFound($this->message[6]['message'], $data);
        }
    }

    public function withdrawRequest(Request $request): JsonResponse
    {
        $data =  $request->only('real_name', 'township', 'division', 'profession', 'currency_convert_id', 'coins');
        $data['user_id'] = auth()->user()->id;
        $data['approve_status'] = 2;
        $data['status'] = 1;
        // random invoice number
        do {
            $number = random_int(100000, 999999);
            $data['invoice_number'] = $number;
        } while (withdrawRequest::where('invoice_number', $number)->first());
        // exchange amount calculate
        $currencyConvert = CurrencyConvert::where('id', $request->currency_convert_id)->where('status', 1)->get()->first();
        $data['amount'] = ($request->coins * $currencyConvert['par_currency']) / $currencyConvert['coin'];
        // chack balance
        // $wallet = Wallet::where('user_id', $data['user_id'])->value('balance');
        $point = Point::where('user_id', $data['user_id'])->first();
        if ($data['coins'] <= $point->total_point) {
            WithdrawRequest::create($data);
            // Wallet::removeBalancePoint($data['user_id'], $data['coins']);
            $balance = $point->value('total_point') - $data['coins'];
            $point->update([
                'total_point' => $balance
            ]);
            return $this->respondWithSuccess('Date added successfully !', $data);
        } else {
            return $this->respondWithUnavilableBalance($this->message[10]['message'], $data);
        }
    }

    public function currencyConvert(): JsonResponse
    {
        $currency_convert = CurrencyConvert::class;
        if ($currency_convert::exists()) {
            $data['currency_convert_info'] = $currency_convert::with('currency')->where('status', 1)->get();
            return $this->respondWithSuccess('Get Data Successfully !', $data);
        } else {
            return $this->respondWithErrorNotFound($this->message[6]['message']);
        }
    }

    public function withdrawHistory(): JsonResponse
    {
        if (auth()->user()) {
            $withdraw = WithdrawRequest::class;
            if ($withdraw::exists()) {
                $data['withdraw_info'] = $withdraw::with('currencyConvert.currency')->where('user_id', auth()->user()->id)->get();
                return $this->respondWithSuccess('Get Data Successfully !', $data);
            } else {
                //return $this->respondWithErrorNotFound($this->message[6]['message']);
                return $this->respondWithErrorNotFound($this->message[1]['message']);
            }
        } else {
            return $this->respondWithUnauthorized($this->message[8]['message']);
        }
    }

    public function userHistory(): JsonResponse
    {
        if (auth()->user()) {
            $userGain = UserGain::class;
            $userQuiz = UserQuiz::class;
            if ($userGain::exists() || $userQuiz::exists()) {
                $data['user_gain_history'] = $userGain::where('user_id', auth()->user()->id)
                    ->get();
                $data['user_quiz_history'] = $userQuiz::where('user_id', auth()->user()->id)
                    ->get();
                return $this->respondWithSuccess($this->message[1]['message'], $data);
            } else {
                return $this->respondWithErrorNotFound($this->message[6]['message']);
            }
        } else {
            return $this->respondWithUnauthorized($this->message[8]['message']);
        }
    }

    public function dailyRewards(Request $request): JsonResponse
    {
        if (\auth()->user()) {
            $dailyReward = DailyRewards::class;
            $data = [
                'user_id'       => auth()->user()->id,
                'description'   => 'Daily Reward',
                'amount'        => Reward::where('name', 'Login')->where('status', 1)->value('reward_point'),
                'gain_status'   => 'Gain',
                'status'        => 1,
            ];
            if ($dailyReward::exists()) {
                $ifExist = $dailyReward::where('user_id', $data['user_id'])
                    ->where('status', $data['status'])
                    ->latest('created_at')
                    ->first();
                if ($ifExist) {
                    $presetTime = Carbon::now();
                    //$coutnHours = $ifExist->created_at->diffForHumans($presetTime);
                    $coutnHours = $ifExist->created_at->diffInSeconds($presetTime) / 3600;

                    if ($coutnHours >= 24) {
                        $dailyReward::create($data);
                        $this->dailyRewardsCreatedUser($data);
                        return $this->respondWithCreated($this->message[1]['message'], $data);
                    } else {
                        return $this->respondWithNotAcceptable($this->message[9]['message']);
                    }
                } else {
                    $dailyReward::create($data);
                    $this->dailyRewardsCreatedUser($data);
                    return $this->respondWithCreated($this->message[1]['message'], $data);
                }
            } else {
                $dailyReward::create($data);
                $this->dailyRewardsCreatedUser($data);
                return $this->respondWithCreated($this->message[1]['message'], $data);
            }
        } else {
            return $this->respondWithUnauthorized($this->message[8]['message']);
        }
    }

    public function dailyRewardsCreatedUser($data)
    {
        UserGain::addGainLoss($data);
        Wallet::addBalancePoint($data['user_id'], $data['amount']);
    }

    public function checkUserQuiz(Request $request): JsonResponse
    {
        if (\auth()->user()) {
            $userQuiz = UserQuiz::class;
            //array 1 ..
            $array1 = [
                'user_id' => auth()->user()->id,
                'quiz_id' => $request->quiz_id,
            ];
            if ($userQuiz::where($array1)->exists()) {
                //get data ..
                $data['user_quiz'] = $userQuiz::where($array1)->first();
                return $this->respondWithFound($this->message[2]['message'], $data);
            } else {
                return $this->respondWithErrorNotFound($this->message[6]['message']);
            }
        } else {
            return $this->respondWithUnauthorized($this->message[8]['message']);
        }
    }
    // adnetworks api
    public function maanAdnetwork(): JsonResponse
    {
        if (auth()->user()) {
            $network = Adnetwork::class;
            if ($network::exists()) {
                $data['adnetwork'] = $network::get();
                return $this->respondWithSuccess('Get Data Successfully !', $data);
            } else {
                return $this->respondWithErrorNotFound('Sorry data not found !');
            }
        } else {
            return $this->respondWithUnauthorized($this->message[8]['message']);
        }
    }
}
