<?php

namespace App\Traits;

use App\Models\Review;

trait ProductModelTrait
{
    public function canUserRateProduct(int $productId): bool
    {
        return Review::where([
                'user_id' => auth()->user()->id,
                'product_id' => $productId
            ])->first() === null;
    }
}
