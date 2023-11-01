<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->default('Pending');
            $table->string('requested_by')->nullable();
            $table->string('active_status')->default('Active');
            $table->string('created_by')->nullable();
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('mark_attendances');
    }
}
