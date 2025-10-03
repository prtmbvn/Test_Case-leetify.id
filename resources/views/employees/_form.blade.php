@php
  /** @var \App\Models\Employee|null $employee */
@endphp

<div class="grid gap-4">
  {{-- Employee ID --}}
  <div>
    <label class="block text-sm mb-1">Employee ID</label>
    <input
      type="text"
      name="employee_id"
      value="{{ old('employee_id', $employee->employee_id ?? '') }}"
      class="border p-2 rounded w-full"
      required
    >
    @error('employee_id')
      <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @else
      <p class="text-xs text-slate-500 mt-1">Contoh: EMP-001 (unik)</p>
    @enderror
  </div>

  {{-- Nama --}}
  <div>
    <label class="block text-sm mb-1">Nama</label>
    <input
      type="text"
      name="name"
      value="{{ old('name', $employee->name ?? '') }}"
      class="border p-2 rounded w-full"
      required
    >
    @error('name')
      <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Departemen --}}
  <div>
    <label class="block text-sm mb-1">Departemen</label>
    <select name="department_id" class="border p-2 rounded w-full" required>
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
    @error('department_id')
      <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Alamat (opsional) --}}
  <div>
    <label class="block text-sm mb-1">Alamat (opsional)</label>
    <textarea
      name="address"
      rows="3"
      class="border p-2 rounded w-full"
      placeholder="Alamat lengkap (opsional)"
    >{{ old('address', $employee->address ?? '') }}</textarea>
    @error('address')
      <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
  </div>
</div>

<div class="flex gap-2 mt-4">
  <button class="px-4 py-2 border rounded hover:bg-gray-50">
    {{ $submitText ?? 'Simpan' }}
  </button>
  <a href="{{ route('employees.index') }}" class="px-4 py-2 border rounded hover:bg-gray-50">Batal</a>
</div>
