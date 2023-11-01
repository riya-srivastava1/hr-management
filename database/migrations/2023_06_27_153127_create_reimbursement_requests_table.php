<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursement_requests', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('request_date')->nullable();
            // $table->string('expense_date')->nullable();
            $table->string('expense_month')->nullable();
            $table->string('expense_category')->nullable();
            $table->string('expense_description')->nullable();
            $table->string('amount')->nullable();
            $table->string('support_documents')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->default('Pending');
            $table->string('active_status')->default('Active');
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('reimbursement_requests');
    }
}
