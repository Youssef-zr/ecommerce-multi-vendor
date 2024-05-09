<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FlashSaleItem extends Model
{
    use HasFactory;
    protected $table = 'flash_sale_items';
    protected $fillable = ['product_id', 'flash_sale_id', 'show_at_home', 'status'];

    /**
     * Get the product associated with the FlashSaleItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

   
}
