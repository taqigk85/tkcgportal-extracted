<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MasterImages;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'wall_type',
        'risk_category',
        'state',
        'city',
        'street',
        'exposure_cate',
        'artwork_image_id',
        'sign_height',
        'sign_length',
        'sign_width',
        'sign_installation_height',
        'sign_depth',
        'block_depth',
        'block_height',
        'open_face',
        'weight',
        'mounting_direction',
        'bottom_sign_to_bolt',
        'bolt_spacing',
        'userId',
        'wind_speed',
        'snow_load',
        'ice',
        'building_code',
        'ASCE_code',
        'total_height',
        'ultimate_wind_speed',
        'cabinet_height',
        'cabinet_width',
        'ice_thickness',
        'cabinet_depth',
        'pole_cover_width',
        'aprox_cabinet_weight',
        'post_spacing',
        'sign_face',
        'open_area_percentage',
        'post_shape',
        'post_size',
        'material',
        'quantity',
        'diameter',
        'grade',
        'individual_or_combined',
        'adjust_length', 'width',
        'depth',
        'drill_diameter',
        'drill_depth'
    ];

     public function artworkImage()
     {
         return $this->belongsTo(MasterImages::class, 'artwork_image_id');
     }

     public function user()
     {
         return $this->belongsTo(User::class, 'userId');
     }
}
