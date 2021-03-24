<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Array_;

class Sale extends Model
{
    use HasFactory;

    public function getPaymentMethods():Array
    {
        return [
            [
                'value' => 'cash',
                'label' => 'Cash'
            ], 
            [
                'value' => 'card',
                'label' => 'Card'
            ]
         ];
    }
}
