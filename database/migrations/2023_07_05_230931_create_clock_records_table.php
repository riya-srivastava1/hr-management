<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClockRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clock_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('break')->nullable();
            $table->string('clock_in')->nullable();
            $table->string('clock_out')->nullable();
            $table->date('date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('elapsed_time')->nullable();
            $table->string('status')->default('Active');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('clock_records');
    }
}
