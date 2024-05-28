<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    use HasFactory;
    protected $table = 'shipping_rules';
    protected $fillable =['name','type','min_cost','cost','status'];
}
