<?php

Route::get('/stuff/{id}', [
    'uses' => 'StuffController@show',
]);
