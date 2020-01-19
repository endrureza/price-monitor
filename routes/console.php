<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('updateprice', function () {
    $products = \App\Product::with('histories')
        ->where('last_updated', '<=', now())
        ->get();

    foreach ($products as $product) {

        $client = new \Goutte\Client();
        $crawler = $client->request('GET',$product->url_fetch);

        $price = $crawler->filter('meta[property="product:price:amount"]')->attr('content');

        $product->price = $price;
        $product->last_updated = now();
        $product->save();

        $product->histories()->create([
            'price' => $price,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
})->describe('Update product price');
