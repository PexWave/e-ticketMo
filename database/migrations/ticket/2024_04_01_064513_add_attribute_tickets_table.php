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
            $table->foreignId('assigned_to')->nullable()->constrained('it_employees')->onDelete('CASCADE');
            $table->foreignId('transferred_to')->nullable()->constrained('it_employees')->onDelete('CASCADE');
            $table->foreignId('transferred_by')->nullable()->constrained('it_employees')->onDelete('CASCADE');
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
