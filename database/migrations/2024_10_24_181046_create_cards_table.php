<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number'); // Holds the generated card number
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade'); // Relation to the group
//            $table->foreignId('team_id')->default(1)->constrained('teams')->onDelete('cascade'); // Relation to the team
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
}

