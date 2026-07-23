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
        Schema::create('niotix_import_errors', function (Blueprint $table) {

            $table->id();

            $table->string('resource_type', 50);
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->string('message');
            $table->longText('exception')->nullable();
            $table->json('payload');
            $table->boolean('resolved')->default(false);
            $table->timestampsTz();
            $table->unique(['resource_type', 'resource_id',]);
            $table->unsignedInteger('attempts')->default(1);
            $table->timestampTz('last_failed_at')->nullable();
            $table->index('resource_type');
            $table->index('resource_id');
            $table->index('resolved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niotix_import_errors');
    }
};
