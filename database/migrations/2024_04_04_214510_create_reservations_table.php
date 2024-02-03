<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /* Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('trip_id')->constrained('trips');
            $table->integer('places_reservees');
            $table->timestamps();
        });
        Schema::enableForeignkeyConstraints();
    }

    /* Reverse the migrations.
     */
    public function down(): void
    {   Schema::table('reservations',function(Blueprint $table){
        $table->dropForeign('user_id');
        $table->dropForeign('trip_id');
    });
        Schema::dropIfExists('reservations');
    }
};
