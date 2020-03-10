<?php

Route::namespace('Api')->group(function () {
    Route::get('/stuffs/{id}', 'StuffController@view')->middleware('token')->name('stuff.view');
    Route::post('/stuffs', 'StuffController@create')->middleware('token')->name('stuff.create');
    Route::post('/login', 'AuthController@login')->name('auth.login');
});
