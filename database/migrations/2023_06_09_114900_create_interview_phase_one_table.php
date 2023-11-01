<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewPhaseOneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('corg')->nullable();
            $table->string('ectc')->nullable();
            $table->string('ctc')->nullable();
            $table->string('date')->nullable();
            $table->string('address')->nullable();
            $table->string('doc')->nullable();
            $table->longText('accept_excel_format')->nullable();
            $table->longText('message')->nullable();
            $table->tinyInteger('attempt_candidate')->nullable();
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
        Schema::dropIfExists('members');
    }
}
