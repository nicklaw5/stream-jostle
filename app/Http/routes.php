<?php

Route::get('/', function () {
    return Larapi::respondOk(); 
});

Route::resource('streams', 'StreamsController');
