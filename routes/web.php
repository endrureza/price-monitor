<?php

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

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@store');
Route::get('/create','HomeController@create');
Route::get('/product/{slug}','HomeController@show');

Route::get('/test', function() {
    $client = new Goutte\Client();
    $crawler = $client->request('GET', 'https://fabelio.com/ip/danish-dining-chair-jati.html');

    echo $crawler->filter('span[data-ui-id="page-title-wrapper"]')->text()."<br>";

    echo $crawler->filter('.page-title__secondary')->text()."<br>";

    echo $crawler->filter('meta[property="product:price:amount"]')->attr('content'). "<br>";

    echo $crawler->filter('meta[property="og:image"]')->attr('content'). "<br>";

    echo $crawler->filter('div#description')->html()."<br>";

    echo $crawler->filter('div#additional-data')->html();
});
