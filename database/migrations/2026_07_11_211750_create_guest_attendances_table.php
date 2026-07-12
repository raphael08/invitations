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
        Schema::create('guest_attendances', function (Blueprint $table) {

    $table->id();

    $table->foreignId('guest_id')->constrained()->cascadeOnDelete();

    $table->foreignId('venue_id')->nullable()->constrained()->nullOnDelete();

    $table->boolean('attended')->default(false);

    $table->timestamp('checked_in_at')->nullable();

    $table->string('checked_in_by')->nullable(); // Admin or usher name

    $table->string('scan_method')->default('QR Code');
    // QR Code, Manual, NFC, etc.

    $table->ipAddress('ip_address')->nullable();

    $table->text('remarks')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_attendances');
    }
};
