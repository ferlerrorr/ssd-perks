<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    public $timestamps = true;
    protected $fillable = [
        'employee_id',
        'card_id',
        'fname',
        'mname',
        'lname',
        'address',
        'company_code',
    ];
}
