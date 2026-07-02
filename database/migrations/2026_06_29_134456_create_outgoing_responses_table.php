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
        Schema::create('outgoing_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outgoing_request_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('status');
            $table->unsignedSmallInteger('status_code');
            $table->string('response_code')->nullable();
            $table->text('message')->nullable();
            $table->uuid('trace_id')->index();
            $table->unsignedInteger('processing_time_ms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_responses');
    }
};
