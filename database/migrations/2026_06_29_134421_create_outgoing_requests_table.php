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
        Schema::create('outgoing_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('trace_id')->index();
            $table->string('target_system');
            $table->string('module');
            $table->string('interface_no');
            $table->string('endpoint_name');
            $table->string('endpoint');
            $table->string('method', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_requests');
    }
};
