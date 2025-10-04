@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="rounded-xl border border-amber-200 bg-amber-300  p-5 mb-6">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-amber-800">Employees</h1>
    </div>
    <a href="{{ route('employees.create') }}"
       class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-gradient-to-br from-amber-50 to-white px-4 py-2 text-amber-900 font-medium hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-1">
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V6h2v5h5v2h-5v5h-2v-5H6v-2z"/></svg>
      Tambah
    </a>
  </div>
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
      <option value="">Semua</option>
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
      <tr class="bg-amber-300 text-center">
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
