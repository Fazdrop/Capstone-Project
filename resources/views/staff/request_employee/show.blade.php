@extends('layouts.app')

@section('title', 'Detail Permintaan Karyawan')
@section('menu-info', 'Detail Permintaan Karyawan')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-green-900 text-center mb-6">Detail Permintaan Karyawan</h2>
        <dl class="divide-y divide-gray-100">

            @php
                // Daftar field dan label dari form HoD (tambah/ubah sesuai kebutuhan!)
                $fields = [
                    ['label' => 'Tanggal Permintaan', 'field' => 'created_at', 'type' => 'date'],
                    ['label' => 'Nama Pemohon', 'field' => 'requester_name'],
                    ['label' => 'Unit Bisnis/Divisi', 'field' => 'division'], // relasi/string
                    ['label' => 'Department', 'field' => 'department'],
                    ['label' => 'Jabatan', 'field' => 'position'],
                    ['label' => 'Jumlah Karyawan', 'field' => 'jumlah'], // fallback: quantity
                    ['label' => 'Lokasi Kerja', 'field' => 'work_location'],
                    ['label' => 'Level/Golongan', 'field' => 'grade_level'],
                    ['label' => 'Status Karyawan', 'field' => 'employment_type'],
                    ['label' => 'Permintaan Baru Untuk', 'field' => 'request_type'],
                    ['label' => 'Alasan Permintaan', 'field' => 'reason'],
                    ['label' => 'Jenis Kelamin', 'field' => 'gender_requirement'],
                    ['label' => 'Pengalaman', 'field' => 'experience_requirement'],
                    ['label' => 'Pendidikan', 'field' => 'education_level'],
                    ['label' => 'Jurusan', 'field' => 'major_requirement'],
                    ['label' => 'Uraian Pekerjaan', 'field' => 'job_description'],
                    ['label' => 'Soft Skill', 'field' => 'soft_skills_requirement'],
                    ['label' => 'Hard Skill', 'field' => 'hard_skills_requirement'],
                ];
            @endphp

            @foreach ($fields as $item)
                @php
                    $value = null;
                    // Special: tanggal format
                    if ($item['field'] === 'created_at') {
                        $value = $req->created_at ? \Carbon\Carbon::parse($req->created_at)->format('d-m-Y') : null;
                    }
                    // Special: division relasi/string fallback
                    elseif ($item['field'] === 'division') {
                        $value = $req->division->name ?? ($req->division ?? null);
                    }
                    // Special: jumlah fallback quantity
                    elseif ($item['field'] === 'jumlah') {
                        $value = $req->jumlah ?? ($req->quantity ?? null);
                    } else {
                        $value = $req->{$item['field']} ?? null;
                    }
                    // === BERSIHKAN ARRAY/JSON ===
                    if (is_string($value) && str_starts_with($value, '[')) {
                        // convert string json (eg: '["Excel"]') ke array dan gabung dengan koma
                        $arr = json_decode($value, true);
                        if (is_array($arr)) {
                            $value = implode(', ', $arr);
                        }
                    }
                @endphp
                @if (!empty($value) && $value !== '-')
                    <div class="flex justify-between py-3">
                        <dt class="font-medium text-gray-700">{{ $item['label'] }}</dt>
                        <dd>{{ $value }}</dd>
                    </div>
                @endif
            @endforeach

            {{-- Status Workflow --}}
            @php
                $statusMap = [
                    'draft' => ['Draft', 'bg-yellow-100 text-yellow-800'],
                    'submitted_by_user' => ['Menunggu Staff HR', 'bg-gray-100 text-gray-800'],
                    'waiting_fpk' => ['Menunggu FPK Staff HR', 'bg-blue-100 text-blue-800'],
                    'fpk_created' => ['FPK Dibuat', 'bg-green-100 text-green-800'],
                    'waiting_manager_approval' => ['Siap Approval', 'bg-indigo-100 text-indigo-800'],
                    'approved' => ['Approved', 'bg-green-700 text-white'],
                    'rejected' => ['Rejected', 'bg-red-100 text-red-800'],
                    'revisi' => ['Revisi', 'bg-yellow-100 text-yellow-800'],
                ];
                $workflow = strtolower($req->workflow_status ?? '');
                $badge = $statusMap[$workflow] ?? [$req->workflow_status ?? '-', 'bg-gray-100 text-gray-800'];
            @endphp
            @if (!empty($req->workflow_status))
                <div class="flex justify-between py-3">
                    <dt class="font-medium text-gray-700">Status</dt>
                    <dd>
                        <span class="px-3 py-1 rounded-lg font-semibold text-xs {{ $badge[1] }}">
                            {{ $badge[0] }}
                        </span>
                    </dd>
                </div>
            @endif
            {{-- File Lampiran --}}
            @if (!empty($req->supporting_documents))
                <div class="flex justify-between py-3">
                    <dt class="font-medium text-gray-700">File Lampiran</dt>
                    <dd>
                        <a href="{{ asset('storage/' . ltrim($req->supporting_documents, '/')) }}" target="_blank"
                            class="inline-flex items-center justify-center w-10 h-10 bg-green-100 hover:bg-green-200 rounded-lg text-green-700 shadow transition"
                            title="Lihat File">
                            <i data-feather="paperclip" class="w-6 h-6"></i>
                        </a>
                    </dd>
                </div>
            @endif


        </dl>
        <div class="mt-8 flex justify-start">
            <a href="{{ route('staff.request_employee.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-900 shadow font-semibold transition">
                Kembali
            </a>
        </div>
    </div>
@endsection
