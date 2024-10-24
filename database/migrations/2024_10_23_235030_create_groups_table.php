<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3); // '001' to '999'
            $table->string('description');
            $table->string('prefix', 3); // Similar to 'code'
            $table->boolean('status')->default(true); // Active or inactive status
            $table->unsignedTinyInteger('consecutive_length')->default(5); // Number from 5 to 10
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Relation to Company model
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
