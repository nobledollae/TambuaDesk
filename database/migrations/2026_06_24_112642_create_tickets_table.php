<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->id();

            $table->string('ticket_number')->unique();

            $table->string('title');

            $table->text('description');

            $table->enum('priority', [
                'Low',
                'Medium',
                'High',
                'Critical'
            ]);

            $table->enum('status', [
                'Open',
                'Assigned',
                'In Progress',
                'Resolved',
                'Closed'
            ])->default('Open');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            // Technician assigned to this ticket
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};