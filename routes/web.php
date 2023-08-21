<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return view('dashboard.form-elements');
});

// Route::get('/test', function () {
//     $client = new Client();
//     $response = $client->get("https://itunes.apple.com/lookup?id=1593043691");
//     $data = json_decode($response->getBody(), true);
//     $downloads = $data['results'][0]['userRatingCountForCurrentVersion'];
//     return $data;
// });

