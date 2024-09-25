<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    public $timestamps = true;
    protected $fillable = [
        'istore',
        'grab',
    ];

    protected $casts = [
        'grab' => 'json',
    ];
}
