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
        Schema::create('phase3s', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->string('hrround')->nullable();
            $table->string('bgv')->nullable();
            $table->string('offerletter')->nullable();
            $table->string('ctc')->nullable();
            $table->string('jdate')->nullable();
            $table->string('repomanager')->nullable();
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
        Schema::dropIfExists('phase3s');
    }
};
