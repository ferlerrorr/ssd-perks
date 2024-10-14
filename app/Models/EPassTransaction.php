<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EPassTransaction extends Model
{
    protected $table = 'e_pass_transaction';
    public $timestamps = true;
    protected $fillable = [
        'employee_id',
        'card_id',
        'employee_ar',
        'employee_ca',
        'transaction_type',
        'transaction_code',
        'pos_rec_no',
        'amount',
        'terminal_id',
        'store_code',
    ];
}
