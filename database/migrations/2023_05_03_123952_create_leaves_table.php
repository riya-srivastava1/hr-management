<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('uid')->unsigned()->default(0);
            $table->integer('emp_id')->unsigned();
            $table->boolean('state')->default(0);
            $table->time('leave_time')->default(Carbon::now()->format('H:i:m'));
            $table->date('leave_date')->default(Carbon::now());
            $table->string('leave_change_reason')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->default('Active');
            $table->boolean('type')->unsigned()->default(1);
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

        Schema::dropIfExists('leaves');
    }
}
