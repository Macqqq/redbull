<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'company',
        'address',
        'address_2',
        'postal_code',
        'city',
        'country',
        'phone',
        'payment_status',
        'payment_method',
        'total',
    ];
}
