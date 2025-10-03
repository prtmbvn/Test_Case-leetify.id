@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-3">Log Absensi</h1>

<form method="get" class="flex gap-2 mb-3">
  <input type="date" name="date_from" value="{{ request('date_from') }}" class="border p-2">
  <input type="date" name="date_to" value="{{ request('date_to') }}" class="border p-2">
  <select name="department_id" class="border p-2">
    <option value="">— Semua Departemen —</option>
    @foreach($departments as $d)
      <option value="{{ $d->id }}" @selected(request('department_id')==$d->id)>{{ $d->department_name }}</option>
    @endforeach
  </select>
  <input type="text" name="employee_id" placeholder="EMP-001 (opsional)" value="{{ request('employee_id') }}" class="border p-2">
  <button class="px-4 py-2 border">Filter</button>
</form>

<table class="w-full border">
  <thead>
    <tr class="bg-gray-100">
      <th class="p-2 border">Tanggal</th>
      <th class="p-2 border">Employee</th>
      <th class="p-2 border">Dept</th>
      <th class="p-2 border">In</th>
      <th class="p-2 border">Out</th>
      <th class="p-2 border">Status In</th>
      <th class="p-2 border">Late (m)</th>
      <th class="p-2 border">Status Out</th>
      <th class="p-2 border">Early (m)</th>
      <th class="p-2 border">Work (m)</th>
    </tr>
  </thead>
  <tbody>
  @forelse($rows as $r)
    <tr>
      <td class="p-2 border">{{ $r->date }}</td>
      <td class="p-2 border">{{ $r->employee_id }} — {{ $r->employee_name }}</td>
      <td class="p-2 border">{{ $r->department }}</td>
      <td class="p-2 border">{{ $r->clock_in }}</td>
      <td class="p-2 border">{{ $r->clock_out ?? '-' }}</td>
      <td class="p-2 border">{{ $r->check_in_status }}</td>
      <td class="p-2 border text-right">{{ $r->late_minutes }}</td>
      <td class="p-2 border">{{ $r->check_out_status }}</td>
      <td class="p-2 border text-right">{{ $r->early_minutes }}</td>
      <td class="p-2 border text-right">{{ $r->work_minutes }}</td>
    </tr>
  @empty
    <tr><td colspan="10" class="p-2 border text-center">Belum ada data</td></tr>
  @endforelse
  </tbody>
</table>

<div class="mt-3">{{ $rows->links() }}</div>
@endsection
