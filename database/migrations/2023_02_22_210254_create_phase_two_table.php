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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->string('intmode')->nullable();
            $table->string('inttype')->nullable();
            $table->string('date')->nullable();
            $table->string('intname')->nullable();
            $table->string('intstatus')->nullable();
            $table->string('reschedule')->nullable();
            $table->string('rdate')->nullable();
            $table->string('intlink')->nullable();
            $table->string('feedback')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->define('Active');
            // $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};
