<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;
    protected $table = 'user_adresses';
    protected $fillable = [
        "user_id", "name", "email", "phone", "country",'city', "state", "zip_code", "adress",
    ];
}
