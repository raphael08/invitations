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
        Schema::create('rsvps', function (Blueprint $table) {

            $table->id();

            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();

            $table->enum('attendance', [
                'Accepted',
                'Declined',
                'Maybe'
            ]);

            $table->integer('adults')->default(1);

            $table->integer('children')->default(0);

            $table->text('message')->nullable();

            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
