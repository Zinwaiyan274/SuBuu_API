<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\EnvController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\PostBackController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdnetworksController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\QuizCategoryController;
use App\Http\Controllers\Admin\MovieCategoryController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\WithdrawRequestController;

Route::get('/', [CustomAuthController::class, 'home'])->name('home');
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('signout', [DashboardController::class, 'signOut'])->name('signout');

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['middleware' => ['auth:sanctum', 'verified', 'admin']], function () {
    //dashboard...
    Route::get('/admin', [DashboardController::class, 'maanIndex'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'dashboard'])->name('dashboard.data');
    //users..
    Route::get('/user', [UserController::class, 'maanUser'])->name('user');
    Route::post('/new-user', [UserController::class, 'maanNewUser'])->name('new-user');
    Route::get('/edit-user/{id?}', [UserController::class, 'maanEditUser'])->name('edit-user');
    Route::post('/update-user/{id}', [UserController::class, 'maanUpdateUser'])->name('update-user');
    Route::delete('/delete-user/{id}', [UserController::class, 'maanDeleteUser'])->name('delete-user');

    // Blog Category
    Route::controller(BlogCategoryController::class)->group(function() {
        Route::get('/blog-category', 'maanCategory')->name('blog-category');
        Route::post('/new-blog-category', 'maanNewCategory')->name('new-blog-category');
        Route::get('/edit-blog-category/{id}', 'maanEditCategory')->name('edit-blog-category');
        Route::post('/update-blog-category/{id}', 'maanUpdateCategory')->name('update-blog-category');
        Route::delete('/delete-blog-category/{id}', 'maanDeleteCategory')->name('delete-blog-category');
    });

    // Blogs CRUD
    Route::controller(BlogController::class)->group(function() {
        Route::get('/blog', 'maanBlog')->name('blog');
        Route::get('/blog/{id}', 'maanViewBlog')->name('view-blog');
        Route::post('/new-blog', 'maanNewBlog')->name('new-blog');
        Route::get('/edit-blog/{id}', 'maanEditBlog')->name('edit-blog');
        Route::post('/update-blog/{id}', 'maanUpdateBlog')->name('update-blog');
        Route::delete('/delete-blog/{id}', 'maanDeleteBlog')->name('delete-blog');
    });


    // Movie Category
    Route::controller(MovieController::class)->group(function() {
        Route::get('/movies', 'index')->name('movies');
        Route::post('/new-movie', 'create')->name('new-movie');
        Route::get('/edit-movie/{id}', 'edit')->name('edit-movie');
        Route::post('/update-movie/{id}', 'update')->name('update-movie');
        Route::delete('/delete-movie/{id}', 'delete')->name('delete-movie');
    });

    // Movie Category
    Route::controller(MovieCategoryController::class)->group(function() {
        Route::get('/movie-category', 'maanCategory')->name('movie-category');
        Route::post('/new-movie-category', 'maanNewCategory')->name('new-movie-category');
        Route::get('/edit-movie-category/{id}', 'maanEditCategory')->name('edit-movie-category');
        Route::post('/update-movie-category/{id}', 'maanUpdateCategory')->name('update-movie-category');
        Route::delete('/delete-movie-category/{id}', 'maanDeleteCategory')->name('delete-movie-category');
    });

    //Quiz category
    Route::get('/quiz-category', [QuizCategoryController::class, 'maanCategory'])->name('quiz-category');
    Route::post('/new-quiz-category', [QuizCategoryController::class, 'maanNewCategory'])->name('new-quiz-category');
    Route::get('/edit-quiz-category/{id}', [QuizCategoryController::class, 'maanEditCategory'])->name('edit-quiz-category');
    Route::post('/update-quiz-category/{id}', [QuizCategoryController::class, 'maanUpdateCategory'])->name('update-quiz-category');
    Route::delete('/delete-quiz-category/{id}', [QuizCategoryController::class, 'maanDeleteCategory'])->name('delete-quiz-category');

    //Quiz
    Route::get('/quiz', [QuizController::class, 'maanQuiz'])->name('quiz');
    Route::post('/new-quiz', [QuizController::class, 'maanNewQuiz'])->name('new-quiz');
    Route::get('/edit-quiz/{id}', [QuizController::class, 'maanEditQuiz'])->name('edit-quiz');
    Route::post('/update-quiz/{id}', [QuizController::class, 'maanUpdateQuiz'])->name('update-quiz');
    Route::delete('/delete-quiz/{id}', [QuizController::class, 'maanDeleteQuiz'])->name('delete-quiz');

    //Question
    Route::get('/question', [QuestionController::class, 'maanQuestion'])->name('question');
    Route::get('/get-question', [QuestionController::class, 'getQuestions'])->name('get-question');
    Route::post('/new-question', [QuestionController::class, 'maanNewQuestion'])->name('new-question');
    Route::get('/edit-question/{id}', [QuestionController::class, 'maanEditQuestion'])->name('edit-question');
    Route::post('/update-question/{id}', [QuestionController::class, 'maanUpdateQuestion'])->name('update-question');
    Route::delete('/delete-question/{id}', [QuestionController::class, 'maanDeleteQuestion'])->name('delete-question');

    //Withdraw method
    Route::get('/withdraw-method', [WithdrawMethodController::class, 'maanWithdrawMethod'])->name('withdraw-method');
    Route::post('/new-withdraw-method', [WithdrawMethodController::class, 'maanNewWithdrawMethod'])->name('new-withdraw-method');
    Route::get('/edit-withdraw-method/{id}', [WithdrawMethodController::class, 'maanEditWithdrawMethod'])->name('edit-withdraw-method');
    Route::post('/update-withdraw-method/{id}', [WithdrawMethodController::class, 'maanUpdateWithdrawMethod'])->name('update-withdraw-method');
    Route::delete('/delete-withdraw-method/{id}', [WithdrawMethodController::class, 'maanDeleteWithdrawMethod'])->name('delete-withdraw-method');

    //Withdraw request
    Route::get('/withdraw-request', [WithdrawRequestController::class, 'maanWithdrawRequest'])->name('withdraw-request');
    Route::post('/new-withdraw-request', [WithdrawRequestController::class, 'maanNewWithdrawRequest'])->name('new-withdraw-request');
    Route::get('/edit-withdraw-request/{id}', [WithdrawRequestController::class, 'maanEditWithdrawRequest'])->name('edit-withdraw-request');
    Route::post('/update-withdraw-request/{id}', [WithdrawRequestController::class, 'maanUpdateWithdrawRequest'])->name('update-withdraw-request');
    Route::delete('/delete-withdraw-request/{id}', [WithdrawRequestController::class, 'maanDeleteWithdrawRequest'])->name('delete-withdraw-request');


    //Settings Info
    Route::get('/settings', [SettingsController::class, 'maanSettings'])->name('settings');
    Route::post('/new-settings', [SettingsController::class, 'maanNewSettings'])->name('new-settings');
    Route::get('/edit-settings/{id}', [SettingsController::class, 'maanEditSettings'])->name('edit-settings');
    Route::post('/update-settings/{id}', [SettingsController::class, 'maanUpdateSettings'])->name('update-settings');
    Route::delete('/delete-settings/{id}', [SettingsController::class, 'maanDeleteSettings'])->name('delete-settings');

    //Adnetworks Info
    Route::get('/adnetworks', [AdnetworksController::class, 'maanAdnetwork'])->name('adnetworks');
    Route::post('/update-adnetwork/{id}', [AdnetworksController::class, 'maanUpdateAdnetwork'])->name('update-adnetwork');

    //Contact
    Route::get('/history', [HistoryController::class, 'maanHistory'])->name('history');
    Route::get("/history-status/{id}", [HistoryController::class, "maanHistoryStatus"])->name("history-status");
    Route::delete('/delete-history/{id}', [HistoryController::class, 'maanDeleteHistory'])->name('delete-history');
    // Currency
    Route::prefix('currency')->controller(Admin\CurrencyController::class)->name('currency.')->group(function () {
        Route::get('/', 'maanIndex')->name('index');
        Route::post('/', 'maanStore')->name('store');
        Route::get('/edit/{currency}', 'maanEdit')->name('edit');
        Route::put('/{currency}', 'maanUpdate')->name('update');
        Route::delete('/destroy/{currency}', 'maanDestroy')->name('destroy');
    });
    //currency convert...
    Route::prefix('currency-convert')->controller(Admin\CurrencyConvertController::class)->name('currency-convert.')->group(function () {
        Route::get('/', 'maanIndex')->name('index');
        Route::post('/', 'maanStore')->name('store');
        Route::put('/{currencyConvert}', 'maanUpdate')->name('update');
        Route::delete('/destroy/{currencyConvert}', 'maanDestroy')->name('destroy');
    });
    //reward route...
    Route::prefix('reward')->controller(Admin\RewardController::class)->name('reward.')->group(function () {
        Route::get('/', 'maanIndex')->name('index');
        Route::post('/', 'maanStore')->name('store');
        Route::put('/{reward}', 'maanUpdate')->name('update');
        Route::delete('/destroy/{reward}', 'maanDestroy')->name('destroy');
    });

    // System settings
    Route::resource('env', EnvController::class)->only('index', 'store');

    //ajax status route..
    Route::get('publish/status/ajax', [AjaxController::class, 'publishStatus'])->name('status.update');
    //withdraw request approved/reject
    Route::get('withdraw/approved/{id}', [AjaxController::class, 'withdrawApproved'])->name('withdraw.approved');
    Route::get('withdraw/reject/{id}', [AjaxController::class, 'withdrawReject'])->name('withdraw.reject');
});
Route::get('/offer/', [Admin\OfferThrowController::class, 'getOffer'])->name('offer');
Route::match(['get', 'post'], '/post-back', [PostBackController::class, 'maanPostBack'])->name('post-back');


/* clear all cache */
Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return back()->with('message', __('Cache has been cleared.'));
});
