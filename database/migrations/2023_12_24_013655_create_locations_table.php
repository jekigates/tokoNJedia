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
        Schema::create('locations', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('notes');
            $table->string('postal_code');
            $table->double('latitude');
            $table->double('longitude');
            $table->char('locationable_id', 36);
            $table->string('locationable_type');
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
        Schema::dropIfExists('locations');
    }
};
