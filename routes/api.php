<?php

Route::namespace('Api')->group(function () {
    Route::post('/stuffs', 'StuffController@create')->name('stuff.create');
});
