<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->char('uuid', 36)->unique();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('apartment_number', 20)->nullable();
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->timestamps(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
