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
        Schema::create('incoming_requests', function (Blueprint $table) {
            $table->id();

            // Correlation
            $table->uuid('trace_id')->index();
            // Source
            $table->string('source_system', 50)->index();

            // Endpoint
            $table->string('module', 10)->index();
            $table->string('interface_no', 20)->index();
            $table->string('endpoint_name')->index();
            $table->string('endpoint');

            // HTTP
            $table->string('method', 10);
            $table->ipAddress('client_ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('content_type')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['module', 'interface_no']);
            $table->index(['module', 'endpoint_name']);
            $table->index(['source_system', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_requests');
    }
};
