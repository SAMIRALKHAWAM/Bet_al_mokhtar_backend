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
        Schema::create('internal_order_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internal_order_id');
            $table->foreign('internal_order_id')->references('id')->on('internal_orders')->cascadeOnDelete();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
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
        Schema::dropIfExists('internal_order_lines');
    }
};
