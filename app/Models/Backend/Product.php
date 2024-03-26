<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $guarded = [];

    /**
     * Get the mainCategory associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainCategory()
    {
        return $this->hasOne(Category::class, 'id', "category_id");
    }
    /**
     * Get the subCategory that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'id', "sub_category_id");
    }
    /**
     * Get the childCategory that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function childCategory()
    {
        return $this->hasOne(ChildCategory::class, 'id', "child_category_id");
    }

    /**
     * Get all of the imageGallery for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageGallery()
    {
        return $this->hasMany(ProductImageGallery::class, 'product_id', 'id');
    }

    /**
     * Get all of the variants for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    /**
     * Get all of the variantItems for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantItems()
    {
        return $this->hasMany(ProductVariantItem::class, 'product_id', 'id');
    }

    /**
     * Get the vendor associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }
}
