<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpassSchedule extends Model
{
    protected $table = 'perks_reset';
    public $timestamps = true;
    protected $fillable = [
        'admin_id',
        'auto_reset_CA',
        'auto_reset_AR',
        'manual_reset_CA',
        'manual_reset_AR',
        'is_active',
    ];
}
