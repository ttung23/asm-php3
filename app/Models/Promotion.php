<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = "promotions";

    protected $fillable = ['product_id', 'name', 'quantity', 'expire_at', 'discount'];
}
