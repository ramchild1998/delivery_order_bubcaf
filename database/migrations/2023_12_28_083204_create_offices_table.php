<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('name');
            $table->string('address');
            $table->integer('zip_code');
            $table->string('pic_name');
            $table->string('pic_contact_num');
            $table->tinyInteger('is_active');
            $table->timestamps();
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('subdistrict_id');
            $table->integer('village_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
