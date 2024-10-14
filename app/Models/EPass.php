<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EPass extends Model
{
    protected $table = 'e_pass';
    public $timestamps = true;
    protected $fillable = [
        'employee_id',
        'card_id',
        'employee_ar',
        'employee_ca',
    ];
}
