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
        Schema::create('google_sheet_settings', function (Blueprint $table) {

    $table->id();

    $table->string('spreadsheet_id');

    $table->string('worksheet_name')->nullable();

    $table->string('credentials_file')->nullable();

    $table->boolean('auto_sync')->default(true);

    $table->integer('sync_interval')->default(5);

    $table->timestamp('last_sync')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_sheet_settings');
    }
};
