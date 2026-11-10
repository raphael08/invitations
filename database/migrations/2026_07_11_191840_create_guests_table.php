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
        Schema::create('guests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')->constrained()->cascadeOnDelete();

            $table->string('guest_code')->nullable();

            $table->string('guest_name')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('side')->nullable();

            $table->string('category')->nullable();

            $table->integer('number_of_guests')->default(1);
            $table->string('invitation_token');

            $table->enum('invitation_status', [
                'Pending',
                'Sent',
                'Delivered',
                'Viewed'
            ])->default('Pending');

            $table->enum('rsvp_status', [
                'Pending',
                'Accepted',
                'Declined',
                'Maybe'
            ])->default('Pending');

            $table->boolean('is_synced')->default(false);

            $table->timestamp('synced_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
