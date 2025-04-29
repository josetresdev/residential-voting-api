<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->char('uuid', 36)->unique();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('voting_session_id')->nullable();
            $table->timestamp('closes_at')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('voting_session_id')->references('id')->on('voting_sessions')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamp('restored_at')->nullable()->default(null);
            $table->timestamps(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
