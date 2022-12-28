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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index()->foreign()->references('id')->on('customers')->onDelete('cascade');
            $table->date('sales_date');
            $table->string('reference_no')->nullable();
            $table->string('total_quantity');
            $table->decimal('sub_amount',10,2)->default(0);
            $table->decimal('other_charge',10,2)->default(0)->nullable();
            $table->decimal('tax',10,2)->default(0)->nullable();
            $table->integer('discount_type')->comment('0 amount, 2 percent')->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->decimal('round_of',10,2)->default(0);
            $table->string('grand_total');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('company_id')->index()->foreign()->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->index()->foreign()->references('id')->on('branches')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id')->index()->foreign()->references('id')->on('warehouses')->onDelete('cascade');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->integer('payment_status')->comment('0 unpaid, 1 paid, 2 partial_paid')->default(0);
            $table->integer('status')->comment('1 parches, 2 return, 3 partial_return, 4 cancel')->default(1);
            $table->string('status_note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
