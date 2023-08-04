<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ['cate_id', 'material_id', 'color_id', 'size_id', 'name', 'sku', 'slug', 'img', 'price', 'quantity', 'description'];
}
