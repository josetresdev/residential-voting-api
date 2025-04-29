<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('question_id');
            $table->string('text', 255);
            $table->unsignedInteger('votes_cache')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamp('restored_at')->nullable()->default(null);
            $table->timestamps(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
