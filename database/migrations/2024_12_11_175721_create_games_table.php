<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->enum('game_type', ['home', 'away'])->after('id');
            $table->string('team1_name');
            $table->string('team1_photo')->default('images/AC-VILA-MEA.ico');
            $table->string('team2_name');
            $table->string('team2_photo');
            $table->string('location');
            $table->dateTime('date_time');
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
