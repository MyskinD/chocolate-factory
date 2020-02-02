<?php

Route::post('/stuff', [
    'uses' => 'Api\StuffController@create',
]);