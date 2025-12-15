<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('manufacturer');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();

            $table->string('category');

            $table->integer('capacity')->nullable();        // batteries
            $table->integer('power_output')->nullable();    // solar panels
            $table->string('connector_type')->nullable();   // connectors
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
