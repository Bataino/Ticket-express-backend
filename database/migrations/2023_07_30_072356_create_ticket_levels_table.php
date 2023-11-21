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
        Schema::create('ticket_levels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('limit')->nullable();
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
        Schema::dropIfExists('ticket_levels');
    }
};
