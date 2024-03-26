<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    use HasFactory;

    public $table = 'product-image-gallery';
    public $fillable = ['product_id', 'image'];

    /**
     * Get the product associated with the ProductImageGallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
