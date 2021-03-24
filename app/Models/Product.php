<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductType;
use App\Models\Unit;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'note',
        'product_type_id',
        'is_measurable',
        'barcode_prefix',
        'unit_id',
        'unit_price',
        'created_by'
    ];

    protected $visible = [
        'id',
        'code',
        'name',
        'note',
        'is_measurable',
        'barcode_prefix',
        'unit_price'
    ];

    /**
     * Get product type of the product
     */
    public function productType()
    {
        $this->belongsTo(ProductType::class);
    }

    /**
     * Get unit of the product
     */
    public function unit()
    {
        $this->belongsTo(Unit::class);
    }

    /**
     * Get creator of the product
     */
    public function creator()
    {
        $this->belongsTo(User::class);
    }
}
