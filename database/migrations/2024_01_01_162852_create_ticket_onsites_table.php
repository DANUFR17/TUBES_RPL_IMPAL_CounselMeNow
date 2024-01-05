<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_onsites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('connect_id')->references('id')->on('connects')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('keluhan', 255);
            $table->boolean('access')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ticket_onsites');
    }
};
