<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Goutte\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return Inertia::render('List', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|max:255|unique:products,url_fetch'
        ]);

        $crawledWeb = $this->crawlingWeb($request->url);

        $slug = Str::slug($request->url);

        $product = new Product;
        $product->slug = $slug;
        $product->name_ind = $crawledWeb['name_ind'];
        $product->name_eng = $crawledWeb['name_eng'];
        $product->short_description = $crawledWeb['description'];
        $product->description = $crawledWeb['description'];
        $product->additional_info = $crawledWeb['additional_info'];
        $product->price = $crawledWeb['price'];
        $product->image = $crawledWeb['image'];
        $product->url_fetch = $request->url;
        $product->last_updated = now();
        $product->save();

        $product->history()->create([
            'price' => $crawledWeb['price'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return Redirect::route('show', $slug);
    }

    public function show(Request $request, string $slug)
    {
        $product = Product::with('histories')->whereSlug($slug)->first();

        return Inertia::render('Show', [
            'product' => $product,
            'slug' => $slug
        ]);
    }

    protected function crawlingWeb(string $url): array
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $name_ind = $crawler->filter('span[data-ui-id="page-title-wrapper"]')->text();

        $name_eng = $crawler->filter('.page-title__secondary')->text();

        $price = $crawler->filter('meta[property="product:price:amount"]')->attr('content');

        $image = $crawler->filter('meta[property="og:image"]')->attr('content');

        $description = $crawler->filter('div#description')->html();

        $additional_info = $crawler->filter('div#additional-data')->html();

        return [
            'name_ind' => $name_ind,
            'name_eng' => $name_eng,
            'price' => $price,
            'image' => $image,
            'description' => $description,
            'additional_info' => $additional_info
        ];
    }
}
