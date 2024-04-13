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
        Schema::create('extension_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('CASCADE');
            $table->timestamp('extension_time')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('CASCADE');
            $table->timestamp('approved_date')->nullable()->useCurrent=true;
            $table->foreignId('requested_by')->nullable()->constrained('it_employees')->onDelete('CASCADE');
            $table->timestamp('requested_date')->useCurrent=true;
            $table->string('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extension_requests');
    }
};
