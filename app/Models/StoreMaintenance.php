<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMaintenance extends Model
{
    protected $table = 'store_maintenance';
    public $timestamps = true;
    protected $fillable = [
        'istore',
        'grab',
    ];
}
