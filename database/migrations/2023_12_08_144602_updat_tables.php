<?php

use Illuminate\Contracts\Database\Eloquent\Builder;
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
        Schema::table("tickets", function(Blueprint $table){
            $table->boolean("is_scanned")->default(0);
        });

        Schema::table("events", function(Blueprint $table){
            $table->longText("description")->change();
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
        Schema::table("tickets", function(Blueprint $table){
            $table->dropColumn("is_scanned");
        }); //
    }
};
