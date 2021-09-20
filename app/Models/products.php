<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'name',
        'description',
        'img',
        'model',
        'provider',
        'notes',
        'category',
        'product_key',
        'unit_sale_key',
        'sale_price',
        'bar_code',

    ];
}
