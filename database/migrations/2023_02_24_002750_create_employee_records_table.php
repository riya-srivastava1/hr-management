<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_records', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('qualification')->nullable();
            $table->string('email')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('ctc')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('photo')->nullable();
            $table->string('employment_code')->nullable();
            $table->string('status')->default('Active');
            $table->string('contact_no')->nullable();
            $table->string('departname')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('location')->nullable();
            $table->string('reporting_manager')->nullable();
            $table->string('shift')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('uan')->nullable();
            $table->string('total_leaves')->nullable();
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
        Schema::dropIfExists('employee_records');
    }
}
