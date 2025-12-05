<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'medicines',
        'prescription_path',
        'status',
    ];
}
