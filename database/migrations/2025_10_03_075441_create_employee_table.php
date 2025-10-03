<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50)->unique(); // ID unik karyawan (referensi ke tabel lain)
            // pakai BIGINT karena default $table->id() di Laravel adalah BIGINT
            $table->foreignId('department_id')
                  ->constrained('department')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete(); // cegah delete departement jika ada employee
            $table->string('name', 255);
            $table->text('address')->nullable();
            $table->timestamps();

            $table->index(['department_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
