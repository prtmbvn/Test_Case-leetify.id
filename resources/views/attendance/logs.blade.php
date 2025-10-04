@extends('layouts.app')

@section('content')
<h1 class="mb-4 text-2xl font-bold text-slate-800">
  Log Absensi
  <span class="mt-1 block h-1 w-24 rounded bg-amber-300"></span>
</h1>


<div class="mb-4 rounded-lg border border-amber-200/70 bg-white p-3">
  <form method="get" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-6">
    <input type="date" name="date_from" value="{{ request('date_from') }}"
           class="w-full rounded-md border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300" />
    <input type="date" name="date_to" value="{{ request('date_to') }}"
           class="w-full rounded-md border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300" />
    <select name="department_id"
            class="w-full rounded-md border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300 lg:col-span-2">
      <option value="">— Semua Departemen —</option>
      @foreach($departments as $d)
        <option value="{{ $d->id }}" @selected(request('department_id')==$d->id)>{{ $d->department_name }}</option>
      @endforeach
    </select>
    <input type="text" name="employee_id" placeholder="EMP-001 (opsional)" value="{{ request('employee_id') }}"
           class="w-full rounded-md border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300" />

    <div class="flex items-center gap-2 lg:col-span-6">
      <button class="rounded-md bg-amber-300 px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-amber-400">
        Filter
      </button>
      <a href="{{ url()->current() }}" class="rounded-md border px-4 py-2 text-sm text-slate-700 hover:bg-amber-50">
        Reset
      </a>
    </div>
  </form>
</div>


<div class="overflow-x-auto rounded-lg border border-amber-200/70 bg-white">
  <table class="w-full text-sm">
    <thead class="bg-amber-50">
      <tr class="text-left text-slate-700">
        <th class="p-3">Tanggal</th>
        <th class="p-3">Employee</th>
        <th class="p-3">Dept</th>
        <th class="p-3">In</th>
        <th class="p-3">Out</th>
        <th class="p-3">Status In</th>
        <th class="p-3 text-right">Late (m)</th>
        <th class="p-3">Status Out</th>
        <th class="p-3 text-right">Early (m)</th>
        <th class="p-3 text-right">Work (m)</th>
        <th class="w-28 p-3">History</th>
      </tr>
    </thead>
    <tbody class="[&>tr:nth-child(even)]:bg-amber-50/20">
      @forelse($rows as $r)
        @php
          $inLate   = (int)($r->late_minutes ?? 0) > 0;
          $outEarly = (int)($r->early_minutes ?? 0) > 0;
        @endphp
        <tr class="hover:bg-amber-50 transition-colors">
          <td class="p-3 border-t border-amber-100">{{ $r->date }}</td>
          <td class="p-3 border-t border-amber-100">{{ $r->employee_id }} — {{ $r->employee_name }}</td>
          <td class="p-3 border-t border-amber-100">{{ $r->department }}</td>
          <td class="p-3 border-t border-amber-100">{{ $r->clock_in }}</td>
          <td class="p-3 border-t border-amber-100">{{ $r->clock_out ?? '-' }}</td>

          <td class="p-3 border-t border-amber-100">
            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs
                         {{ $inLate ? 'border-amber-300 bg-amber-50 text-amber-800' : 'border-emerald-200 bg-emerald-50 text-emerald-800' }}">
              {{ $r->check_in_status }}
            </span>
          </td>

          <td class="p-3 border-t border-amber-100 text-right {{ $inLate ? 'font-semibold text-amber-700' : 'text-slate-600' }}">
            {{ $r->late_minutes }}
          </td>

          <td class="p-3 border-t border-amber-100">
            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs
                         {{ $outEarly ? 'border-amber-300 bg-amber-50 text-amber-800' : 'border-sky-200 bg-sky-50 text-sky-800' }}">
              {{ $r->check_out_status }}
            </span>
          </td>

          <td class="p-3 border-t border-amber-100 text-right {{ $outEarly ? 'font-semibold text-amber-700' : 'text-slate-600' }}">
            {{ $r->early_minutes }}
          </td>

          <td class="p-3 border-t border-amber-100 text-right">{{ $r->work_minutes }}</td>

          <td class="p-3 border-t border-amber-100">
            <a class="rounded-md bg-amber-300 px-2.5 py-1 text-xs font-semibold text-slate-900 hover:bg-amber-400"
               href="{{ route('attendance-histories.index', ['attendance_id' => $r->attendance_id]) }}">
              Lihat
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="11" class="p-6 text-center text-slate-600">Belum ada data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">
  {{ $rows->links() }}
</div>
@endsection
