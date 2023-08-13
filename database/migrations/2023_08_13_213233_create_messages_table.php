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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('chat_id')->constrained('chats'); // Foreign key referencing the chat session
            $table->foreignId('sender_id')->constrained('users'); // Foreign key referencing the sender
            $table->text('content'); // The text content of the message
            $table->boolean('read')->default(false); // Flag to indicate if the message has been read
            $table->timestamps(); // created_at for when the message was sent
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
