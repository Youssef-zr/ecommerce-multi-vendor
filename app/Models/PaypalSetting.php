<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalSetting extends Model
{
    use HasFactory;
    protected $table = 'paypal_settings';
    protected $fillable = [
        'status', 'account_mode', 'country_name',
        'currency_name', 'currency_rate',
        'sandbox_client_id', 'sandbox_secret_key',
        'live_client_id', 'live_secret_key',
    ];
}
