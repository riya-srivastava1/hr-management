<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Postanddep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postanddeps', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->string('title')->nullable();
            $table->string('department')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('postanddeps');
    }
}
