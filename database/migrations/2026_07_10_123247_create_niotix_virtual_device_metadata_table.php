<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('niotix_virtual_device_metadata', function (Blueprint $table) {
            $table->id();

            $table->foreignId('virtual_device_id')
                ->constrained('niotix_virtual_devices')
                ->cascadeOnDelete()
                ->unique();

            $table->string('fa_icon')->nullable();

            $table->json('groups')->nullable();
            $table->json('tags')->nullable();
            $table->json('key_value_data')->nullable();
            $table->json('target_reference_ids')->nullable();
            $table->json('location_data')->nullable();
            $table->json('header_image')->nullable();
            $table->json('attachments')->nullable();

            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niotix_virtual_device_metadata');
    }
};
