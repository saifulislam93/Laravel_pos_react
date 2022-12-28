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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id')->index()->foreign()->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign()->references('id')->on('products')->onDelete('cascade');
            $table->decimal('quantity',10,2)->default(0);
            $table->decimal('unit_price',10,2)->default(0);
            $table->decimal('sub_amount',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0);
            $table->integer('discount_type')->comment('0 amount, 2 percent')->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->decimal('total_amount',10,2)->default(0);
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
        Schema::dropIfExists('sales_details');
    }
};
