<?php

Route::namespace('Api')->group(function () {
    Route::get('/stuffs/{id}', 'StuffController@view')->name('stuff.view');
    Route::post('/stuffs', 'StuffController@create')->name('stuff.create');
});
