<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'car_model_name',
        'weight',
        'part_number',
        'manufacturer',
        'compatibility',
        'material',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

