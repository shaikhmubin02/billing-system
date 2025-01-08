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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('bill_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_items');
        Schema::dropIfExists('bills');
    }
};
