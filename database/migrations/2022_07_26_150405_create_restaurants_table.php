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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->text('about')->nullable();
            $table->string('website_url')->nullable();
            $table->time('working_hours')->nullable();
            $table->string('location');
            $table->enum('category', ['All', 'Continental', 'Local'])->default('All');
            $table->json('images');
            $table->string('profileimage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
