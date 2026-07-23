<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('niotix_virtual_devices', function (Blueprint $table) {
            $table->id();

            // Niotix IDs
            $table->unsignedBigInteger('niotix_device_id')->unique();
            $table->string('device_id')->unique();

            // Device
            $table->string('name');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('device_type')->nullable();
            $table->unsignedBigInteger('device_driver_id');
            $table->unsignedBigInteger('device_template_id')->nullable();
            $table->string('connector_type');
            $table->unsignedBigInteger('connector_config_id');
            $table->string('region', 50)->nullable();
            $table->string('activation', 50)->nullable();
            $table->unsignedBigInteger('line_number')->nullable();

            // System
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('scope_id')->nullable();
            $table->boolean('disabled')->default(false);

            // Niotix timestamps
            $table->timestampTz('last_seen')->nullable();
            $table->timestampTz('niotix_created_at')->nullable();
            $table->timestampTz('niotix_updated_at')->nullable();

            $table->timestampsTz();

            // Indexes
            $table->index('name');
            $table->index('parent_id');
            $table->index('device_type');
            $table->index('device_driver_id');
            $table->index('last_seen');
            $table->index('disabled');
            $table->index('account_id');
            $table->index('scope_id');
            $table->index('connector_config_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niotix_virtual_devices');
    }
};
