<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voting_sessions', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->char('uuid', 36)->unique();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamp('restored_at')->nullable()->default(null);
            $table->timestamps(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voting_sessions');
    }
};
