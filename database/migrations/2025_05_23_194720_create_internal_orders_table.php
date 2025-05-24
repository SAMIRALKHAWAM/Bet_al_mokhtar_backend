<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('internal_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables')->cascadeOnDelete();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->cascadeOnDelete();
            $table->unsignedBigInteger('waiter_id');
            $table->foreign('waiter_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->integer('discount')->default(0);
            $table->integer('full_price');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_orders');
    }
};
