<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internal_order_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internal_order_id');
            $table->foreign('internal_order_id')->references('id')->on('internal_orders')->cascadeOnDelete();
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers')->cascadeOnDelete();
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_order_offers');
    }
};
