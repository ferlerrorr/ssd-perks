<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StoreClient extends Model
{

    protected $table = 'cashier';
    protected $fillable = [
        'employee_id',
        'password',
    ];
}
