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
        Schema::create('tmp_files', function (Blueprint $table) {
            $table->increments('id_file');
            $table->string('file_name', length: 255);
            $table->string('sent_time', length: 255);
            $table->string('expire_time', length: 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_files');
    }
};
