<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    protected $visible = [ 'id', 'name' ];

    /** 
     * Get products for the product type
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
