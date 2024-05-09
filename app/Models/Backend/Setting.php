<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'generale_settings';
    protected $fillable = ['site_name','layout','contact_email','currency_name','currency_icon','time_zone'];
}
