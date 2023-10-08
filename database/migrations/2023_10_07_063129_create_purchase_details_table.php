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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchases_id');
            $table->unsignedBigInteger('inventory_id');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
            $table->foreign('purchases_id')->references('id')->on('purchases')->onDelete('cascade');;
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
