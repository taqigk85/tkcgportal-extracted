<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('projects', function (Blueprint $table) {

            //  SIGN INPUTS
            $table->decimal('total_height')->nullable();
            $table->string('ultimate_wind_speed')->nullable();
            $table->decimal('cabinet_height')->nullable();
            $table->decimal('cabinet_width')->nullable();
            $table->decimal('ice_thickness')->nullable();
            $table->decimal('cabinet_depth')->nullable();
            $table->decimal('pole_cover_width')->nullable();
            $table->decimal('aprox_cabinet_weight')->nullable();
            $table->decimal('post_spacing')->nullable();


            // Advanced User
            $table->string('sign_face')->nullable();
            $table->string('open_area_percentage')->nullable();


            // Post Size
            $table->string('post_shape')->nullable();
            $table->string('post_size')->nullable();
            $table->string('material')->nullable();


            // Anchor Bolt
            $table->integer('quantity')->nullable();
            $table->string('diameter')->nullable();
            $table->string('grade')->nullable();

            // Spread Footing
            $table->string('individual_or_combined')->nullable();
            $table->decimal('adjust_length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('depth')->nullable();

            // Drill Pier Foundation
            $table->decimal('drill_diameter')->nullable();
            $table->decimal('drill_depth')->nullable();
        });
    }

    public function down() {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'total_height', 'ultimate_wind_speed', 'cabinet_height', 'cabinet_width', 'ice_thickness',
                'cabinet_depth', 'pole_cover_width', 'aprox_cabinet_weight',
                'post_spacing', 'sign_face', 'open_area_percentage', 'post_shape', 'post_size', 'material',
                'quantity', 'diameter', 'grade', 'individual_or_combined', 'adjust_length', 'width', 'depth', 'drill_diameter','drill_depth'
            ]);
        });
    }
};
