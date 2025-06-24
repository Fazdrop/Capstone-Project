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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama posisi/jabatan
            $table->string('department')->nullable();
            $table->string('division')->nullable();
            $table->text('description')->nullable(); // Uraian/deskripsi pekerjaan
            $table->text('requirements')->nullable(); // Persyaratan
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable(); // Misal: Full Time/Contract
            $table->date('deadline')->nullable(); // Tanggal penutupan
            $table->boolean('is_active')->default(true); // Status tampil/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
