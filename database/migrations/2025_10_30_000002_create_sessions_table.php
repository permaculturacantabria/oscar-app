<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('listener_id')->nullable()->constrained('listeners')->nullOnDelete();
            $table->string('listener_name')->nullable();
            $table->dateTime('scheduled_at');
            $table->enum('status', ['pendiente', 'realizada'])->default('pendiente');
            $table->text('notes')->nullable();
            $table->json('categories')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};


