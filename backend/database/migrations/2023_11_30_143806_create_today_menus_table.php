<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('today_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('images'); // Define a JSON column for storing an array of image URLs
            $table->decimal('price', 8, 2)->default(0);
            $table->string('description');
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
        Schema::dropIfExists('today_menus');
    }
};