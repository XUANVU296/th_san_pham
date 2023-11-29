<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_tag extends Model
{
    use HasFactory;
    protected $table = 'product_tag';

    protected $fillable = [
        'name',
        'product_id',
        'tag_id',
    ];
}
