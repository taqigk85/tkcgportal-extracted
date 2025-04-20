<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('wall_type');
            $table->string('risk_category');
            $table->string('exposure_cate');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->unsignedBigInteger('artwork_image_id');
            $table->decimal('sign_height', 10, 2);
            $table->decimal('sign_length', 10, 2);
            $table->decimal('sign_width', 10, 2);
            $table->decimal('sign_installation_height', 10, 2);
            $table->decimal('sign_depth', 10, 2);
            $table->decimal('block_depth', 10, 2);
            $table->decimal('block_height', 10, 2);
            $table->string('open_face');
            $table->decimal('weight', 10, 2);
            $table->string('mounting_direction');
            $table->decimal('bottom_sign_to_bolt', 10, 2);
            $table->decimal('bolt_spacing', 10, 2);
            $table->unsignedBigInteger('userId');
            $table->timestamps();
            $table->foreign('artwork_image_id')->references('id')->on('master_images')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->integer('ice')->nullable();
            $table->text('ASCE_code')->nullable();
            $table->text('building_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
