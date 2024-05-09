<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FlashSale extends Model
{
    use HasFactory;
    protected $table ='flash_sales';
    protected $fillable = ['end_date'];

    /**
     * Get all of the items for the FlashSale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flashSaleItems(): HasMany
    {
        return $this->hasMany(FlashSaleItem::class, 'flash_sale_id', 'id');
    }

    /**
     * Get the product associated with the FlashSale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
