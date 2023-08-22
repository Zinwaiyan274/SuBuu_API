<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Currency;
use App\Models\Api\Question;
use App\Models\CurrencyConvert;
use App\Models\WithdrawRequest;
use App\Models\Api\DailyRewards;
use App\Models\Api\QuizCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function maanIndex()
    {
        $data['latest_quiz'] = Quiz::where('status', 1)->latest()->get()->take(5);
        $data['wallet_max'] = Wallet::with('user')->orderBy('balance', 'DESC')->take(5)->get();

        return view('back-end.pages.dashboard', compact('data'));
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function dashboard()
    {
        $data['quiz_category'] = QuizCategory::count();
        $data['total_balance'] = number_format(Wallet::sum('balance'), 2);
        $data['total_quizes'] = Quiz::count();
        $data['total_questions'] = Question::count();
        $data['total_withdraw'] = number_format(WithdrawRequest::sum('amount'), 2);
        $data['pending_withdraw'] = number_format(WithdrawRequest::where('approve_status', '2')->sum('amount'), 2);
        $data['approved_withdraw'] = number_format(WithdrawRequest::where('approve_status', '3')->sum('amount'), 2);
        $data['rejected_withdraw'] = number_format(WithdrawRequest::where('approve_status', '0')->sum('amount'), 2);
        $data['total_user'] = User::where('user_type', 'User')->count();
        $data['total_currency'] = Currency::count();
        $data['currency_covert'] = CurrencyConvert::count();
        $data['total_rewards'] = number_format(DailyRewards::sum('amount'), 2);

        $data['withdraws_data'] = WithdrawRequest::selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) as total')
                                ->orderBy('created_at')
                                ->groupBy('year', 'month')
                                ->get();

        return response()->json($data);
    }
}
