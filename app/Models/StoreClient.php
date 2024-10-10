<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreClient extends Model
{
    use HasFactory;
    protected $table = 'cashier';
    protected $fillable = [
        'employee_id',
        'password',
    ];
}
