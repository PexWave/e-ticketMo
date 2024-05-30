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
        Schema::create('task_types', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->foreignId('category_id')->constrained('categories')->onDelete('CASCADE');
            $table->tinyInteger('difficulty');
            $table->tinyInteger('urgency');
            $table->unsignedMediumInteger('response_time')->nullable();
            $table->unsignedMediumInteger('resolve_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_types');
    }
};
