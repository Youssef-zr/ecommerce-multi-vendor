<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    public $table = 'product-variants';
    public $fillable = ['name', 'product_id','status'];

    /**
     * Get all of the variantItems for the ProductVariant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantItems()
    {
        return $this->hasMany(ProductVariantItem::class, 'variant_id', 'id');
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
