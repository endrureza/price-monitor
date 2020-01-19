<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    public function histories(): HasMany
    {
        return $this->hasMany('\App\ProductPriceHistory', 'product_id');
    }
}
