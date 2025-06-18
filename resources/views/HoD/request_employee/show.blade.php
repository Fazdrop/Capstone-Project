@extends('layouts.app')

@section('title', 'Detail Permintaan Karyawan')
@section('menu-info', 'Detail Permintaan Karyawan')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-green-900 text-center mb-6">Detail Permintaan Karyawan</h2>
        <dl class="divide-y divide-gray-100">
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Nomor Request</dt>
                <dd>{{ $request->request_number }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Tanggal Permintaan</dt>
                <dd>{{ \Carbon\Carbon::parse($request->request_date)->format('d-m-Y') }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Nama Pemohon</dt>
                <dd>{{ $request->requester_name }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Divisi</dt>
                <dd>{{ $request->division->name ?? '-' }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Jabatan</dt>
                <dd>{{ $request->position }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Jumlah Dibutuhkan</dt>
                <dd>{{ $request->quantity }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Lokasi Kerja</dt>
                <dd>{{ $request->work_location }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="font-medium text-gray-700">Status</dt>
                <dd>
                    @php
                        $statusMap = [
                            'user_submit' => ['User Submit', 'bg-green-100 text-green-800'],
                            'disetujui' => ['Disetujui', 'bg-blue-100 text-blue-800'],
                            'ready_for_approval' => ['Ready for Approval', 'bg-yellow-100 text-yellow-800'],
                            'fpk_terisi' => ['FPK Terisi', 'bg-gray-100 text-gray-800'],
                        ];
                        $workflow = strtolower(str_replace(' ', '_', $request->workflow_status));
                        $badge = $statusMap[$workflow] ?? [$request->workflow_status, 'bg-gray-100 text-gray-800'];
                    @endphp
                    <span class="px-3 py-1 rounded-lg font-semibold text-xs {{ $badge[1] }}">
                        {{ $badge[0] }}
                    </span>
                </dd>
            </div>
        </dl>
        <div class="mt-8 flex justify-start">
            <a href="{{ route('hod.request_employee.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-300  hover:bg-gray-400 text-gray-900 shadow font-semibold transition">
                Kembali
            </a>

        </div>
    </div>
@endsection
