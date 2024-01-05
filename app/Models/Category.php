<?php

namespace App\Models;
use App\Policies\CategoryPolicy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'status'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
