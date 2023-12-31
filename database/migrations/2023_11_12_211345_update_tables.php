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
        Schema::table("events", function (Blueprint $table) {
            $table->boolean("is_publish")->default(false);
        });

        Schema::table("discounts", function (Blueprint $table) {
            $table->boolean("status")->default(false);
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('event_id')->after('user_id')->nullable()->constrained('events')->onDelete('cascade');
        });

        Schema::table('ticket_levels', function (Blueprint $table) {
            $table->boolean('is_available')->default(1);
            $table->integer('bought')->default(0)->change();
            $table->float('price');
        });
        
        Schema::table('campaigns', function (Blueprint $table) {
            $table->enum('status', ['draft', 'sending' ,'sent'])->default('draft');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable()->change();
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
        Schema::table("events", function (Blueprint $table) {
            $table->dropColumn("is_publish");
        });

        Schema::table("discounts", function (Blueprint $table) {
            $table->dropColumn("status");
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('event_id');
        });

        Schema::table('ticket_levels', function (Blueprint $table) {
            $table->dropColumn('is_available');
            $table->dropColumn('price');
        }); 
        
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('phone');
            $table->string('email');
        });

    }
};
