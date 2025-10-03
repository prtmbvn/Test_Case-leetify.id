<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            // fk ke employee.employee_id (string)
            $table->string('employee_id', 50);
            $table->string('attendance_id', 100)->unique(); // jadi FK untuk history
            $table->timestamp('clock_in')->nullable();
            $table->timestamp('clock_out')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('employee_id')->on('employee')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->index(['employee_id', 'clock_in']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
