<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('category');
            $table->index('manufacturer');
            $table->index('price');

            $table->index('capacity');
            $table->index('power_output');
            $table->index('connector_type');

            $table->fullText(['name', 'manufacturer', 'description']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('category');
            $table->dropIndex('manufacturer');
            $table->dropIndex('price');

            $table->dropIndex('capacity');
            $table->dropIndex('power_output');
            $table->dropIndex('connector_type');

            $table->dropFullText(['name', 'manufacturer', 'description']);
        });
    }
};
