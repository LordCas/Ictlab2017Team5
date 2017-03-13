<?php

use Illuminate\Http\Request;

Route::get('plants', ['uses' => 'PlantController@plants']);
Route::get('plant/remove/{id}', ['uses' => 'PlantController@remove']);
Route::get('water/{id}', ['uses' => 'PlantController@water']);

Route::post('plant/new', ['uses' => 'PlantController@new']);
Route::post('plant/action/{id}', ['uses' => 'PlantController@action']);

Route::get('action', ['uses' => 'PlantController@getCurrentAction']);
Route::get('action/finish', ['uses' => 'PlantController@finishAction']);
