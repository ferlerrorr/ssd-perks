<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartSku extends Model
{
    protected $fillable = [
        'istore',
        'inumbr',
        'ibhand',
        'price',
        'pack_per_piece',
        'vendor_stocks',
        'price_per_pack',
    ];

    protected $casts = [
        'istore' => 'string',
        'inumbr' => 'string',
        'ibhand' => 'string',
        'price' => 'string',
        'pack_per_piece' => 'string',
        'vendor_stocks' => 'string',
        'price_per_pack' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Check if pack_per_piece is not null and not zero
            if (!is_null($model->pack_per_piece) && $model->pack_per_piece != 0) {
                // Divide ibhand by pack_per_piece and set vendor_stocks
                $model->vendor_stocks = floor($model->ibhand / $model->pack_per_piece);

                // Multiply pack_per_piece by price and set price_per_pack
                $model->price_per_pack = ceil($model->pack_per_piece * $model->price);
            } else {
                // If pack_per_piece is null or 0, set vendor_stocks and price_per_pack to null
                $model->vendor_stocks = null;
                $model->price_per_pack = null;
            }
        });
    }
}
