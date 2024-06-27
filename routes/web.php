<?php

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Api\QuestionnaireController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::resource('answers', AnswerController::class)->names('admin.answers');
Route::resource('questions', QuestionController::class)->names('admin.questions');
Route::resource('products', ProductController::class)->names('admin.products');

Route::get('answers/create/{question_id?}', [AnswerController::class, 'create'])->name('admin.answers.create');

Route::get('/', function () {
    return view('admin/welcome');
})->name('admin.index');

Route::prefix('api')->withoutMiddleware([VerifyCsrfToken::class])->group(function () {
    Route::get('questionnaire', [QuestionnaireController::class, 'questionnaire']);
    Route::post('recommendation', [QuestionnaireController::class, 'recommendation']);
});

