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
        Schema::table('tickets', function(Blueprint $table){
            $table->foreignId('assigned_to')->constrained('it_employees')->onDelete('CASCADE')->nullable();
            $table->foreignId('transferred_to')->constrained('it_employees')->onDelete('CASCADE')->nullable();
            $table->foreignId('transferred_by')->constrained('it_employees')->onDelete('CASCADE')->nullable();
            $table->timestamp('new_resolve')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
