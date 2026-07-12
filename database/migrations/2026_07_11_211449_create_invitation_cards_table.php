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
        Schema::create('invitation_cards', function (Blueprint $table) {
            $table->id();
             $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->string('qr_code')->nullable();
            $table->string('card_image')->nullable();
            $table->timestamp('generated_at')->nullable();
            $table->integer('download_count')->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_cards');
    }
};
