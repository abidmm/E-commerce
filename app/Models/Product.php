<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'tax_percentage',
        'image'
    ];

     public function cart(){
        return $this->hasMany(Cart::class , 'product_id');
     }
}
