<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('department_name', 255);
            $table->time('max_clock_in_time');
            $table->time('max_clock_out_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
