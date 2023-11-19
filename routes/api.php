<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->name('api.')->group(function () {
    Route::controller(Api\UserController::class)->group(function (){
        Route::post('/sign-up','maanRegistration')->name('signup');
        Route::post('/sign-in','maanSignIn')->name('signin');
        Route::post('/send-reset-code',[Auth\ForgotPasswordController::class,'sendResetCode']);
        Route::post('/verify-reset-code',[Auth\ResetPasswordController::class,'verifyCode']);
        Route::post('/user-password-reset',[Auth\ResetPasswordController::class,'userResetPassword']);
    });
    Route::middleware('auth:sanctum')->group( function () {
        Route::controller(Api\UserController::class)->name('user.')->group(function (){
            Route::get('/sign-out','maanSignOut');
            Route::get('/user','userInfo')->name('info');
            Route::get('/balance','balanceInfo')->name('balance');
            Route::post('/profile-update','profileUpdate');
            Route::post('/password-update','passwordUpdate');
            //user refresh token ...
            Route::post('/refresh-token','userRefreshToken');
        });

        Route::controller(Api\AdminInfoController::class)->group(function (){
            Route::get('/category','categoryInfo')->name('category');
            Route::get('/quiz','quizInfo')->name('quiz');
            Route::get('/question','questionInfo')->name('question');
            Route::get('/rewards','rewardInfo')->name('rewards');
            Route::get('/category-quiz','categoryWiseQuiz')->name('category.quiz');
            Route::post('/add-point-spin','addPointSpin');
            Route::post('/remove-point','removePointSpin');
            Route::post('/add-point-quiz','addPointQuiz');
            Route::get('/quiz/{category_id}', 'quizByCategory')->name('quiz.category');
            //withdraw api..
            Route::post('/withdraw-request','withdrawRequest');
            Route::get('/withdraw-history','withdrawHistory');
            // currency api ...
            Route::get('/currency-convert','currencyConvert');
            //user gain history ...
            Route::get('/user-history','userHistory');
            // daily rewards ...
            Route::post('/daily-rewards','dailyRewards');
            // daily rewards ...
            Route::post('/daily-rewards','dailyRewards');
            //check user quiz ...
            Route::post('/check-user-quiz','checkUserQuiz');
            //adnetworks api..
            Route::get('/adnetworks','maanAdnetwork');
        });

        Route::controller(Api\BlogController::class)->group(function () {
            Route::get('/blogs', 'blogList')->name('blog-list');
            Route::get('/blogs/{id}/detail', 'blogDetail')->name('blog-detail');
        });

        Route::controller(Api\GameController::class)->group(function() {
            Route::get('/games', 'gameList')->name('game-list');
            Route::get('games/{id}/detail', 'gameDetail')->name('game-detail');
        });

        Route::get('/blog-categories', [Api\BlogCategoryController::class, 'categoryList'])->name('blog-categories');

        /* Point System */
        Route::controller(Api\PointController::class)->group(function() {
            Route::get('/get-point', 'getPoint')->name('get-point');
            Route::post('/give-point', 'givePoint')->name('give-point');
            Route::post('/subtract-point', 'subtractPoint')->name('subtract-point');
        });

        Route::controller(Api\MovieController::class)->group(function() {
            Route::get('/movies' , 'movieList')->name('movie-list');
            Route::get('/movie/{id}' , 'movieDetail')->name('movie-detail');
        });

        Route::controller(Api\MusicController::class)->group(function() {
            Route::get('/music', 'musicList')->name('music-list');
            Route::get('/single-music/{id}', 'singleMuisc')->name('single-music');
        });

        Route::controller(Api\NotificationController::class)->group(function() {
            Route::get('/notifications/point' , 'getPointNotifications');
            Route::get('/notifications' , 'getNotifications');
        });
    });
});

