<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendance_history', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50);
            $table->string('attendance_id', 100);
            $table->timestamp('date_attendance');   // waktu event (in/out)
            $table->tinyInteger('attendance_type'); // 1=In, 2=Out
            $table->text('description')->nullable();
            $table->timestamps();

            // FK
            $table->foreign('employee_id')
                ->references('employee_id')->on('employee')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('attendance_id')
                ->references('attendance_id')->on('attendance')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->index(['employee_id', 'date_attendance']);
            $table->index(['attendance_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_history');
    }
};
