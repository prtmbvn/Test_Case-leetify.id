
<section class="flex items-center justify-center w-screen mt-10">
<div class="rounded-xl border border-amber-200 bg-amber-300 p-6 mb-6">
  <div class="flex items-start gap-3 mb-5">
    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-amber-50 to-white flex items-center justify-center text-amber-900">
      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V6h2v5h5v2h-5v5h-2v-5H6v-2z"/></svg>
    </div>
    <div>
      <h2 class="text-lg font-semibold text-amber-900">Form Karyawan</h2>
      <p class="text-sm text-amber-800/80">Lengkapi data di bawah. Kolom bertanda * wajib diisi.</p>
    </div>
  </div>

  <div class="grid gap-4">
    
    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">
        Employee ID <span class="text-red-500">*</span>
      </label>
      <input
        type="text"
        name="employee_id"
        value="{{ old('employee_id', $employee->employee_id ?? '') }}"
        class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300 border-amber-200 @error('employee_id') border-red-300 @enderror bg-white"
        required
      >
      @error('employee_id')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @else
        <p class="text-xs text-amber-800/80 mt-1">Contoh: <span class="font-mono">EMP-001</span> (unik)</p>
      @enderror
    </div>

    
    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">
        Nama <span class="text-red-500">*</span>
      </label>
      <input
        type="text"
        name="name"
        value="{{ old('name', $employee->name ?? '') }}"
        class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300 border-amber-200 @error('name') border-red-300 @enderror bg-white"
        required
      >
      @error('name')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    
    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">
        Departemen <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <select
          name="department_id"
          class="w-full appearance-none rounded-lg border px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-amber-300 border-amber-200 @error('department_id') border-red-300 @enderror"
          required
        >
          <option value="">— Pilih Departemen —</option>
          @foreach($department as $d)
            <option
              value="{{ $d->id }}"
              @selected(old('department_id', $employee->department_id ?? null) == $d->id)
            >
              {{ $d->department_name }}
            </option>
          @endforeach
        </select>
        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-amber-700/70">
          <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"/></svg>
        </span>
      </div>
      @error('department_id')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    
    <div>
      <label class="block text-sm font-medium text-slate-800 mb-1">Alamat (opsional)</label>
      <textarea
        name="address"
        rows="3"
        class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300 border-amber-200 @error('address') border-red-300 @enderror bg-white"
        placeholder="Alamat lengkap (opsional)"
      >{{ old('address', $employee->address ?? '') }}</textarea>
      @error('address')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>
  </div>

  <div class="mt-6 flex gap-2">
    <button
      class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-gradient-to-br from-amber-50 to-white px-4 py-2 text-amber-900 font-medium hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400"
    >
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H7a2 2 0 0 0-2 2v14l7-3 7 3V5a2 2 0 0 0-2-2z"/></svg>
      {{ $submitText ?? 'Simpan' }}
    </button>
    <a
      href="{{ route('employees.index') }}"
      class="rounded-lg border px-4 py-2 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-300"
    >
      Batal
    </a>
  </div>
</div>
</section>
