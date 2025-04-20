<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $fillable =[
        'state',
        'cities',
        'risk_1',
        'risk_2',
        'risk_3',
        'risk_4',
        'building_code',
        'ASCE_code'
    ];
}
