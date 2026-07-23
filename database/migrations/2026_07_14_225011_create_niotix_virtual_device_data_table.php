<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('niotix_virtual_device_data', function (Blueprint $table) {

            $table->id();
            $table->foreignId('virtual_device_id')->unique();
            $table->foreign('virtual_device_id')
                ->references('id')
                ->on('niotix_virtual_devices')
                ->cascadeOnDelete();
            $table->json('device_data')->nullable();

            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niotix_virtual_device_data');
    }
};
