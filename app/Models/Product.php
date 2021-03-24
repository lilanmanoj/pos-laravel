<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\ProductType;
use App\Models\Unit;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    use Searchable;

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
        'unit_price',
        'productType',
        'unit',
        'creator'
    ];

    protected $searchable = [
        'id',
        'code',
        'name',
        'note'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->searchable;
    }

    /**
     * Get product type of the product
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get unit of the product
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get creator of the product
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
