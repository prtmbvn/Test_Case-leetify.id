@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-xl font-semibold">Employees</h1>
  <a href="{{ route('employees.create') }}" class="px-3 py-2 border rounded hover:bg-gray-50">+ Tambah</a>
</div>

<form method="get" class="flex flex-wrap items-end gap-3 mb-4">
  <div>
    <label class="block text-xs text-slate-500 mb-1">Cari (ID/Nama)</label>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="EMP-001 / Budi"
           class="border p-2 rounded w-64">
  </div>
  <div>
    <label class="block text-xs text-slate-500 mb-1">Departemen</label>
    <select name="department_id" class="border p-2 rounded w-64">
      <option value="">— Semua —</option>
      @foreach($department as $d)
        <option value="{{ $d->id }}" @selected(request('department_id')==$d->id)>{{ $d->department_name }}</option>
      @endforeach
    </select>
  </div>
  <div class="flex gap-2">
    <button class="px-4 py-2 border rounded hover:bg-gray-50">Filter</button>
    @if(request()->hasAny(['search','department_id']))
      <a href="{{ route('employees.index') }}" class="px-3 py-2 text-sm hover:underline">Reset</a>
    @endif
  </div>
</form>

<div class="overflow-x-auto">
  <table class="w-full border">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-2 border">Employee ID</th>
        <th class="p-2 border">Nama</th>
        <th class="p-2 border">Departemen</th>
        <th class="p-2 border">Alamat</th>
        <th class="p-2 border w-44">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($employees as $e)
        <tr>
          <td class="p-2 border font-mono">{{ $e->employee_id }}</td>
          <td class="p-2 border">{{ $e->name }}</td>
          <td class="p-2 border">{{ $e->department->department_name ?? '-' }}</td>
          <td class="p-2 border">{{ $e->address ?? '-' }}</td>
          <td class="p-2 border">
            <div class="flex gap-2">
              <a href="{{ route('employees.edit', $e) }}" class="px-2 py-1 border rounded text-sm hover:bg-gray-50">Edit</a>
              <form action="{{ route('employees.destroy', $e) }}" method="post"
                    onsubmit="return confirm('Hapus karyawan {{ $e->name }}?')">
                @csrf @method('DELETE')
                <button class="px-2 py-1 border rounded text-sm hover:bg-gray-50">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="p-2 border text-center text-slate-500">Belum ada data</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-3">{{ $employees->links() }}</div>
@endsection
