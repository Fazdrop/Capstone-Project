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
        Schema::create('applicants', function (Blueprint $table) {

            $table->id();
            $table->foreignId('job_vacancy_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('marital_status')->nullable();
            $table->text('ktp_address')->nullable();
            $table->text('current_address')->nullable();
            $table->string('emergency_contact_1')->nullable();
            $table->string('emergency_contact_2')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('national_id')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('last_education')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('major')->nullable();
            $table->year('entry_year')->nullable();
            $table->year('graduation_year')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('work_period')->nullable();
            $table->text('job_description')->nullable();
            $table->text('reason_for_leaving')->nullable();
            $table->text('technical_skills')->nullable();
            $table->text('non_technical_skills')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->string('reference')->nullable();
            $table->string('hobby')->nullable();
            $table->string('applied_position')->nullable();
            $table->string('cv_file_name')->nullable();
            $table->string('photo_file_name')->nullable();
            $table->date('application_date')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('cv')->nullable();
            $table->string('photo')->nullable();
            // Fields below are filled by HR staff
            $table->string('status')->nullable();
            $table->date('interview_date')->nullable();
            $table->time('interview_time')->nullable();
            $table->string('interview_link')->nullable();
            $table->string('interview_location')->nullable();
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
