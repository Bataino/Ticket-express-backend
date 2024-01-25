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
        Schema::table("events", function(Blueprint $table){
            $table->dateTime('end')->nullable()->change();
            $table->string("attendees")->nullable();
            $table->foreignId("venue_id")->nullable()->change();
        });

        Schema::table("users", function(Blueprint $table){
            $table->string("company")->nullable();
            $table->string("attendees")->nullable();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("events", function(Blueprint $table){
            $table->dropColumn("attendees");
        });//

        Schema::table("users", function(Blueprint $table){
            $table->dropColumn("attendees");
            $table->dropColumn("company");
        });//
    }
};
