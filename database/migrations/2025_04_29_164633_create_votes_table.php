<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->char('uuid', 36)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('option_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamp('restored_at')->nullable()->default(null);
            $table->timestamps(0);
            $table->unique(['user_id', 'question_id'], 'unique_vote');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
