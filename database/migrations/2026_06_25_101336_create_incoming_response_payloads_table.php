<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incoming_response_payloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_response_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->json('payload');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incoming_response_payloads');
    }
};
