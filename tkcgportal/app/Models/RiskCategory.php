<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'state', 'cities', 'risk_categories', 'building_code', 'asce_code'
    ];

    protected $casts = [
        'cities' => 'array',
        'risk_categories' => 'array',
    ];
}
