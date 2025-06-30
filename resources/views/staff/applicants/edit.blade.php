@extends('layouts.app')

@section('title', 'Proses Pelamar')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 px-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i data-feather="edit-3" class="w-6 h-6"></i>
                Proses Pelamar: {{ $applicant->full_name }}
            </h1>
            <a href="{{ route('staff.applicants.show', $applicant) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-sm transition flex items-center gap-2">
                <i data-feather="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <form method="POST" action="{{ route('staff.applicants.update', $applicant) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Posisi yang Dilamar</label>
                    <div class="bg-gray-100 px-4 py-3 rounded-lg">
                        <div class="font-medium">{{ $applicant->applied_position }}</div>
                        <div class="text-sm text-gray-500">{{ $applicant->jobVacancy->title ?? '-' }}</div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status Pelamar</label>
                    <select id="status" name="status" class="w-full border border-gray-300 rounded-lg p-2.5"
                        x-data="{ status: '{{ old('status', $applicant->status ?? 'new') }}' }" x-model="status" required>
                        <option value="new" {{ old('status', $applicant->status) == 'new' ? 'selected' : '' }}>Baru
                        </option>
                        <option value="review" {{ old('status', $applicant->status) == 'review' ? 'selected' : '' }}>Dalam
                            Review</option>
                        <option value="interview" {{ old('status', $applicant->status) == 'interview' ? 'selected' : '' }}>
                            Interview</option>
                        <option value="passed" {{ old('status', $applicant->status) == 'passed' ? 'selected' : '' }}>Lolos
                        </option>
                        <option value="rejected" {{ old('status', $applicant->status) == 'rejected' ? 'selected' : '' }}>
                            Ditolak</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ status: '{{ old('status', $applicant->status ?? 'new') }}' }">
                    <div class="mb-6" x-show="status === 'interview'">
                        <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-6">
                            <h3 class="font-medium text-indigo-700 mb-2">Pengaturan Interview</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="interview_date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal
                                        Interview</label>
                                    <input type="date" id="interview_date" name="interview_date"
                                        value="{{ old('interview_date', $applicant->interview_date ? \Carbon\Carbon::parse($applicant->interview_date)->format('Y-m-d') : '') }}"
                                        class="w-full border border-gray-300 rounded-lg p-2.5">
                                    @error('interview_date')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="interview_time" class="block text-gray-700 text-sm font-medium mb-1">Jam
                                        Interview</label>
                                    <input type="time" id="interview_time" name="interview_time"
                                        value="{{ old('interview_time', $applicant->interview_time) }}"
                                        class="w-full border border-gray-300 rounded-lg p-2.5">
                                    @error('interview_time')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Tipe Interview</label>
                                <div class="flex space-x-4" x-data="{ interviewType: '{{ old('interview_type', $applicant->interview_link ? 'online' : ($applicant->interview_location ? 'offline' : 'online')) }}' }">
                                    <label class="flex items-center">
                                        <input type="radio" name="interview_type" value="online" x-model="interviewType"
                                            class="mr-2">
                                        <span>Online/Video Call</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="interview_type" value="offline" x-model="interviewType"
                                            class="mr-2">
                                        <span>Offline/Tatap Muka</span>
                                    </label>

                                    <div class="mt-3 w-full" x-show="interviewType === 'online'">
                                        <label for="interview_link"
                                            class="block text-gray-700 text-sm font-medium mb-1">Link Meeting</label>
                                        <input type="url" id="interview_link" name="interview_link"
                                            value="{{ old('interview_link', $applicant->interview_link) }}"
                                            placeholder="https://meet.google.com/..."
                                            class="w-full border border-gray-300 rounded-lg p-2.5">
                                        @error('interview_link')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 w-full" x-show="interviewType === 'offline'">
                                        <label for="interview_location"
                                            class="block text-gray-700 text-sm font-medium mb-1">Lokasi</label>
                                        <input type="text" id="interview_location" name="interview_location"
                                            value="{{ old('interview_location', $applicant->interview_location) }}"
                                            placeholder="Ruang Meeting Lt. 3"
                                            class="w-full border border-gray-300 rounded-lg p-2.5">
                                        @error('interview_location')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="additional_notes" class="block text-gray-700 font-medium mb-2">Catatan</label>
                        <textarea id="additional_notes" name="additional_notes" rows="3"
                            class="w-full border border-gray-300 rounded-lg p-2.5" placeholder="Tambahkan catatan tentang pelamar ini...">{{ old('additional_notes', $applicant->additional_notes) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('staff.applicants.index') }}"
                        class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
