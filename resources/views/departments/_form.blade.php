<section class="w-screen flex items-center justify-center mt-10">
<div class="rounded-xl border border-amber-200 bg-amber-300 p-6 mb-6">
  <div class="flex items-start gap-3 mb-5">
    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-amber-50 to-white  flex items-center justify-center text-amber-900">
      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V6h2v5h5v2h-5v5h-2v-5H6v-2z"/></svg>
    </div>
    <div>
      <h2 class="text-lg font-semibold text-amber-900">Form Department</h2>
      <p class="text-sm text-amber-800/80">Isi data departemen & jam maksimal absensi.</p>
    </div>
  </div>

  <div class="grid gap-4 max-w-xl">
    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">Nama Departemen</label>
      <input type="text" name="department_name"
             value="{{ old('department_name', $department->department_name ?? '') }}"
             class="w-full rounded-lg border border-amber-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300 @error('department_name') border-red-300 @enderror bg-white"
             required>
      @error('department_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">Waktu Maksimal Absen Masuk</label>
      <input type="time" name="max_clock_in_time"
             value="{{ old('max_clock_in_time', isset($department)? substr($department->max_clock_in_time,0,5) : '') }}"
             class="w-full rounded-lg border border-amber-200 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-amber-300 @error('max_clock_in_time') border-red-300 @enderror"
             required>
      <p class="text-xs text-amber-800/80 mt-1">Format HH:MM (contoh 09:00)</p>
      @error('max_clock_in_time') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">Waktu Maksimal Absen Keluar</label>
      <input type="time" name="max_clock_out_time"
             value="{{ old('max_clock_out_time', isset($department)? substr($department->max_clock_out_time,0,5) : '') }}"
             class="w-full rounded-lg border border-amber-200 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-amber-300 @error('max_clock_out_time') border-red-300 @enderror"
             required>
      <p class="text-xs text-amber-800/80 mt-1">Format HH:MM (contoh 17:00)</p>
      @error('max_clock_out_time') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
  </div>

  <div class="mt-6 flex gap-2">
    <button
      class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-gradient-to-br from-amber-50 to-white px-4 py-2 text-amber-900 font-medium hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400">
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H7a2 2 0 0 0-2 2v14l7-3 7 3V5a2 2 0 0 0-2-2z"/></svg>
      {{ $submitText ?? 'Simpan' }}
    </button>
    <a href="{{ route('departments.index') }}"
       class="rounded-lg border px-4 py-2 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-300">
      Batal
    </a>
  </div>
</div>
</section>
