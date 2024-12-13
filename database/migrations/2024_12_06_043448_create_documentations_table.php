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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->text('topic');
            $table->string('category')->nullable();
            $table->string('source')->nullable();
            $table->longText('description');
            $table->enum('status', ['public', 'private'])->default('private');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Add the foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
