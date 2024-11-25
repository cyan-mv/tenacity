<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGroupTable extends Migration
{
    public function up()
    {
        Schema::create('client_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['client_id', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_group');
    }
}
