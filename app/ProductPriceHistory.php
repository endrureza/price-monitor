<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPriceHistory extends Model
{
    protected $table = 'product_price_histories';

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo('\App\Product');
    }
}
