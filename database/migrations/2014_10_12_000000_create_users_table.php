<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('foto_profil')->default("https://bootdey.com/img/Content/avatar/avatar1.png");
            $table->string('role')->default('User');
            $table->string('name');
            $table->date('tgl_lahir');
            $table->string('no_hp')->unique();
            $table->string('email')->unique();
            $table->string('spesialis')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
