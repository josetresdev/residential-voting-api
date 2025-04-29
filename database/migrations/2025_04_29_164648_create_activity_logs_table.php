<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action', 255);
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable(); // Agregar columna ip_address
            $table->string('user_agent', 255)->nullable(); // Agregar columna user_agent
            $table->unsignedBigInteger('target_id')->nullable(); // Agregar columna target_id
            $table->string('target_table', 255)->nullable(); // Agregar columna target_table
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
