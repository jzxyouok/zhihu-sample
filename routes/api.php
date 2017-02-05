<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/topics', function (Request $request) {
    return \App\Topic::select(['id', 'name'])
        ->where('name', 'like', '%'.$request->query('q').'%')
        ->get();
});

Route::middleware('auth:api')->name('questions.follow')
    ->post('question/{question}/follow', 'QuestionsController@follow');

Route::middleware('auth:api')->name('users.follow')
    ->post('users/{user}/follow', 'UsersController@follow');

Route::middleware('auth:api')->name('answers.vote')
    ->post('answer/{answer}/vote', 'AnswersController@vote');

Route::middleware('auth:api')->name('users.send.message')
    ->post('users/{user}/message', 'MessagesController@send');
