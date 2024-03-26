<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;
    public $table = 'product-variant-items';
    public $guarded = [];

    /**
     * Get the variant associated with the ProductVariantItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function variant()
    {
        return $this->hasOne(ProductVariant::class, 'id', 'variant_id');
    }


    /**
     * Get the product associated with the ProductVariant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
