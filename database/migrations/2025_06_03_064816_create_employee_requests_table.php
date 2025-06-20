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
            Schema::create('employee_requests', function (Blueprint $table) {
                $table->id(); //1
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); //1.1 user_id sebagai pemohon
                $table->foreignId('division_id')->nullable()->constrained()->onDelete('set null');
                $table->string('request_number'); //2 nomor fpk
                $table->date('request_date'); //3 tanggal permintaan
                $table->string('requester_name'); //4 nama pemohon
                $table->string('business_unit_division'); //5 unit bisnis
                $table->string('department'); //6 departemen
                $table->string('position'); //7 jabatan
                $table->integer('quantity')->default(1); //8 jumlah permintaan
                $table->string('work_location'); //9 lokasi kerja
                $table->string('grade_level')->nullable(); //10 Level Golongan
                $table->enum('employment_type', ['contract', 'permanent'])->default('contract'); //11 status karyawan
                $table->date('contract_end_date')->nullable(); //12 tanggal akhir kontrak
                $table->enum('request_type', ['new', 'replace'])->default('new'); //13 jenis permintaan/permintaan untuk
                $table->enum('replacement_reason', ['resign', 'mutation', 'promotion',])->nullable(); //14 penggantian
                $table->text('reason')->nullable(); //15 alasan permintaan
                $table->enum('gender_requirement', ['male', 'female', 'any'])->default('male'); //16 kualifikasi jenis kelamin & tambahkan any
                $table->integer('min_age_requirement')->nullable(); //17 kualifikasi_usia_min
                $table->integer('max_age_requirement')->nullable(); //18 kualifikasi_usia_max
                $table->string('experience_requirement')->nullable(); //19 kualifikasi pengalaman
                $table->text('additional_requirements')->nullable(); //20 kualifikasi tambahan
                $table->date('required_date')->nullable(); //21 tanggal bergabung yang diharapkan
                $table->string('job_type')->nullable(); //22 tipe pekerjaan
                $table->string('special_criteria')->nullable(); //23 kriteria khusus
                $table->text('education_level')->nullable(); // atau string, json, dsb
                $table->string('major_requirement')->nullable(); //25 jurusan pendidikan
                $table->text('job_description')->nullable(); //26 deskripsi pekerjaan
                $table->text('soft_skills_requirement')->nullable(); //27 soft skill
                $table->text('hard_skills_requirement')->nullable(); //28 hard skill
                $table->string('supporting_documents')->nullable(); //29 dokumen pendukung
                $table->string('supporting_documents_original_name')->nullable(); // nama asli dokumen pendukung
                $table->string('workflow_status')->default('submitted_by_user'); //30 status alur kerja
                $table->text('suggested_tasks_and_responsibilities')->nullable(); //31 tugas dan tanggung jawab yang disarankan
                $table->text('notes')->nullable(); //32 catatan tambahan
                $table->timestamps();
            });
        }






        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('employee_requests');
        }
    };
