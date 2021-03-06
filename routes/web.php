<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;

Route::get('/', [AuthController::class, 'home'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('create-registration', [AuthController::class, 'createRegistration'])->name('register.create'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('showVisitor/{id}', [SurveyController::class, 'showVisitor'])->name('survey.showVisitor');
Route::get('createAnswerVisitor/{id}', [SurveyController::class, 'createAnswerVisitor'])->name('survey.createAnswerVisitor');
Route::post('saveAnswerVisitor', [SurveyController::class, 'saveAnswerVisitor'])->name('survey.saveAnswerVisitor');
Route::get('showVisitor/{id}', [SurveyController::class, 'showVisitor'])->name('survey.showVisitor');
Route::post('succesVisitor', [SurveyController::class, 'succesVisitor'])->name('survey.succesVisitor');
    
Route::group(['middleware'=>['auth', 'isAdmin']], function() {
    Route::resource('survey', SurveyController::class);
    Route::get('datas', [AuthController::class, 'datas']);
    Route::get('createDetails/{id}', [SurveyController::class, 'createDetails'])->name('createDetails');
    Route::post('storeDetails', [SurveyController::class, 'storeDetails'])->name('storeDetails');
    Route::get('adminShow/{id}', [SurveyController::class, 'show'])->name('survey.adminShow');
    Route::get('index', [SurveyController::class, 'index'])->name('survey.adminIndex');
    Route::put('editDetails', [SurveyController::class, 'editDetails'])->name('survey.editDetails');
    Route::post('searchAdmin', [SurveyController::class, 'search'])->name('searchAdmin');
});

Route::group(['middleware'=>['auth', 'isUser']], function() {
    Route::get('surveys', [AuthController::class, 'surveys']);
    Route::get('answer', [AuthController::class, 'answer'])->name('answer');
    Route::get('surveyIndex', [SurveyController::class, 'userIndex'])->name('survey.index');
    Route::get('show/{id}', [SurveyController::class, 'userShow'])->name('survey.show');
    Route::get('createAnswer/{id}', [SurveyController::class, 'createAnswer'])->name('survey.createAnswer');
    Route::get('comment/{id}', [SurveyController::class, 'comment'])->name('survey.comment');
    Route::post('succes', [SurveyController::class, 'succes'])->name('survey.succes');
    Route::post('saveAnswer', [SurveyController::class, 'saveAnswer'])->name('survey.saveAnswer');
    Route::post('storeComment', [SurveyController::class, 'storeComment'])->name('storeComment');
    Route::post('searchUser', [SurveyController::class, 'search'])->name('searchUser');
});