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
        Schema::dropIfExists('activities');

        Schema::create('activities', function (Blueprint $table) {

            $table->id();

            // Store ticket information permanently
            $table->string('ticket_number');
            $table->string('ticket_title');

            // User who performed the action
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Action performed
            $table->string('action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};