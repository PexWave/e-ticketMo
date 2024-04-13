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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_status')->default("Pending");
            $table->timestamp('actual_response')->nullable();
            $table->timestamp('actual_resolve')->nullable();
            $table->timestamp('modified_date')->useCurrent = true;
            $table->timestamp('reference_date')->useCurrent = true;
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void 
    {
        Schema::dropIfExists('tickets');
    }
};
