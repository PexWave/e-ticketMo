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
            if (!Schema::hasColumn('tickets', 'task_type_id')) {
                $table->foreignId('task_type_id')->constrained('task_types')->onDelete('CASCADE');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('tickets', function (Blueprint $table) {
        //     $table->dropConstrainedForeignId('task_type_id');
        // });
    }
};
