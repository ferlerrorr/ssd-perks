<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'sku';
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key column

    protected $fillable = [
        'SKU_Number',
        'SKU_Current_Price',
        'grab_pack',
        // Add other fields as needed
    ];

    public $timestamps = true;
}
