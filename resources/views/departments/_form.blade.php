@php /** @var \App\Models\Department|null $department */ @endphp

<div class="grid gap-4 max-w-xl">
  <div>
    <label class="block text-sm mb-1">Nama Departemen</label>
    <input type="text" name="department_name"
           value="{{ old('department_name', $department->department_name ?? '') }}"
           class="border p-2 rounded w-full" required>
  </div>

  <div>
    <label class="block text-sm mb-1">Waktu Maksimal Absen Masuk</label>
    <input type="time" name="max_clock_in_time"
           value="{{ old('max_clock_in_time', isset($department)? substr($department->max_clock_in_time,0,5) : '') }}"
           class="border p-2 rounded w-full" required>
    <p class="text-xs text-slate-500 mt-1">Format HH:MM (contoh 09:00)</p>
  </div>

  <div>
    <label class="block text-sm mb-1">Waktu Maksimal Absen Keluar</label>
    <input type="time" name="max_clock_out_time"
           value="{{ old('max_clock_out_time', isset($department)? substr($department->max_clock_out_time,0,5) : '') }}"
           class="border p-2 rounded w-full" required>
    <p class="text-xs text-slate-500 mt-1">Format HH:MM (contoh 17:00)</p>
  </div>
</div>

<div class="flex gap-2 mt-4">
  <button class="px-4 py-2 border rounded hover:bg-gray-50">{{ $submitText ?? 'Simpan' }}</button>
  <a href="{{ route('departments.index') }}" class="px-4 py-2 border rounded hover:bg-gray-50">Batal</a>
</div>
