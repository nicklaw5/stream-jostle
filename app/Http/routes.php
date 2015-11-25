<?php

Route::get('/', function () {
	phpinfo();
    // return Larapi::respondOk(); 
});

Route::resource('streams', 'StreamsController');
