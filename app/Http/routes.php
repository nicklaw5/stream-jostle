<?php

Route::get('/', function () {
    return Larapi::respondOk(); 
});

Route::resource('games', 'GamesController');
Route::resource('streams', 'StreamsController');
