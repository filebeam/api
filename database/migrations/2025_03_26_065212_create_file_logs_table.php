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
        Schema::create('file_logs', function (Blueprint $table) {
            $table->increments('id_file');
            $table->string('timestamp', length: 255);
            $table->string('date_time', length: 255);
            $table->string('user_agent', length: 255);
            $table->string('ip_addr', length: 255);
            $table->string('file_name', length: 255);
            $table->string('hash', length: 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_logs');
    }
};
