<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('outgoing_request_payloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outgoing_request_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->json('headers')->nullable();
            $table->longText('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_request_payloads');
    }
};
