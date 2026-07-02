<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incoming_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('incoming_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('status', 20)->index();
            $table->unsignedSmallInteger('status_code');

            $table->string('response_code', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('trace_id', 100)->nullable()->index();

            $table->string('path')->nullable();

            $table->unsignedInteger('processing_time_ms')->nullable();

            $table->timestamps();

            $table->index(['status', 'status_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incoming_responses');
    }
};
