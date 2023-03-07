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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('name_tm');
            $table->string('name_en')->nullable();
            $table->string('image')->nullable();
            $table->unsignedDouble('price');
            $table->unsignedFloat('discount_percent')->default(0);
            $table->dateTime('discount_start')->useCurrent();
            $table->dateTime('discount_end')->useCurrent();
            $table->unsignedInteger('prep_duration')->default(0);
            $table->string('slug')->unique();
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
