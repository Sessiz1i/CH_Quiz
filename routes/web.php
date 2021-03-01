<?php


    use App\Http\Controllers\Admin\QuestionController;
    use App\Http\Controllers\Admin\QuizController;
    use App\Http\Controllers\HomeController;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\Route;

    Route::get('/storageling', function () {
        return Artisan::call('storage:link');
    });
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */


    Route::get('/',                                             [HomeController::class,'welcome'])->name('welcome');



    // Login Route
    Route::middleware(['auth:sanctum', 'verified'])->name('home.')->group(function (){

        Route::get('quiz/{slug}',                   [HomeController::class,'quiz'])->name('quiz.join');
        Route::get('quiz/detay/{slug}',             [HomeController::class,'detail'])->name('quiz.detay');
        Route::post('quiz/{slug}/result',           [HomeController::class,'result'])->name('quiz.result');
        Route::get('quizzes/{user}/my-result',       [HomeController::class,'myQuizzes'])->name('my-quizzes');

    });

    // Admin Route
    Route::middleware(['auth:sanctum', 'verified', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {

        Route::resource('quizzes',                  QuizController::class);
        Route::resource('quiz/{quiz_id}/questions', QuestionController::class);

    });


