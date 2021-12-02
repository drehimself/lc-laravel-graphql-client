<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $response = Http::post('http://lc-laravel-graphql.test/graphql', [
        'query' => '
            query {
                posts {
                    data {
                    id
                    title
                }
            }
        }
        '
    ]);

    return view('welcome', [
        'posts' => $response->json()['data']['posts']['data'],
    ]);
});

Route::get('/create', function () {
    $response = Http::post('http://lc-laravel-graphql.test/graphql', [
        'query' => '
            mutation {
                createPostResolver(user_id: 1, title: "Hello from Laravel", body: "Laravel") {
                    id
                    title
                }
            }
        '
    ]);

    return $response->json();
});
