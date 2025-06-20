{{-- resources/views/partials/modal-delete.blade.php --}}
<div
    x-show="showDeleteModal"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50"
>
    <div @click.away="showDeleteModal = false" class="bg-white rounded-xl shadow-2xl p-7 max-w-sm w-full mx-auto">
        <h3 class="text-xl font-bold text-red-700 mb-4">
            {{ $title ?? 'Konfirmasi Hapus' }}
        </h3>
        <p class="text-gray-700 text-base mb-6">
            {{ $description ?? 'Apakah Anda yakin ingin menghapus item ini? Aksi ini tidak dapat dibatalkan.' }}
        </p>
        <div class="flex justify-end gap-3">
            <button
                @click="showDeleteModal = false"
                type="button"
                class="px-5 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition duration-200 ease-in-out">
                Batal
            </button>
            <form :action="deleteUrl" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition duration-200 ease-in-out">
                    {{ $buttonLabel ?? 'Hapus' }}
                </button>
            </form>
        </div>
    </div>
</div>
