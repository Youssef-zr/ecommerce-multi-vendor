<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        "name",
        "code",
        "quantity",
        "max_use",
        "start_date",
        "end_date",
        "discount_type",
        "discount",
        "status",
        "total_used",
    ];
}
