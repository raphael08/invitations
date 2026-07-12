<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
             $table->foreignId('event_type_id')->constrained()->cascadeOnDelete();
            $table->string('app_name');
            $table->string('bride_name')->nullable();
            $table->string('groom_name')->nullable();
            $table->string('wedding_title')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('background_music')->nullable();
            $table->timestamp('event_date');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
