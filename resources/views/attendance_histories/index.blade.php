@extends('layouts.app')
@section('title','Attendance History')

@section('content')
<h1 class="mb-4 text-2xl font-bold text-slate-800">
  Attendance History
  <span class="mt-1 block h-1 w-28 rounded bg-amber-300"></span>
</h1>

<form method="get" class="mb-4 flex flex-wrap gap-2">
  <input type="text" name="employee_id" value="{{ request('employee_id') }}" placeholder="EMP-001"
         class="rounded border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300">
  <input type="text" name="attendance_id" value="{{ request('attendance_id') }}" placeholder="UUID attendance"
         class="rounded border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300">
  <select name="type" class="rounded border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300">
    <option value="">— Tipe —</option>
    <option value="1" @selected(request('type')==='1')>Check-in</option>
    <option value="2" @selected(request('type')==='2')>Check-out</option>
  </select>
  <input type="date" name="date_from" value="{{ request('date_from') }}"
         class="rounded border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300">
  <input type="date" name="date_to" value="{{ request('date_to') }}"
         class="rounded border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300">
  <button class="rounded bg-amber-300 px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-amber-400">Filter</button>
  @if(request()->hasAny(['employee_id','attendance_id','type','date_from','date_to']))
    <a href="{{ route('attendance-histories.index') }}" class="rounded border px-3 py-2 text-sm text-slate-700 hover:bg-amber-50">Reset</a>
  @endif
</form>

<div class="overflow-x-auto rounded border border-amber-200/70 bg-white shadow-sm">
  <table class="w-full min-w-[900px] text-sm">
    <thead class="bg-amber-50">
      <tr class="text-left text-slate-700">
        <th class="p-3 border-b border-amber-100">Waktu</th>
        <th class="p-3 border-b border-amber-100">Employee</th>
        <th class="p-3 border-b border-amber-100">Attendance ID</th>
        <th class="p-3 border-b border-amber-100">Tipe</th>
        <th class="p-3 border-b border-amber-100">Deskripsi</th>
        <th class="p-3 border-b border-amber-100 w-28">Aksi</th>
      </tr>
    </thead>
    <tbody class="[&>tr:nth-child(even)]:bg-amber-50/20">
      @forelse($histories as $h)
        <tr class="transition-colors hover:bg-amber-50">
          
          <td class="p-3 border-t border-amber-100">{{ $h->date_attendance }}</td>
          <td class="p-3 border-t border-amber-100">{{ $h->employee_id }}</td>
          <td class="p-3 border-t border-amber-100 font-mono text-[12px] break-all">{{ $h->attendance_id }}</td>
          <td class="p-3 border-t border-amber-100">
            @if($h->attendance_type==1)
              <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-800">IN</span>
            @elseif($h->attendance_type==2)
              <span class="inline-flex items-center rounded-full border border-sky-200 bg-sky-50 px-2.5 py-0.5 text-xs font-semibold text-sky-800">OUT</span>
            @else
              <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-semibold text-slate-700">N/A</span>
            @endif
          </td>
          <td class="p-3 border-t border-amber-100">{{ $h->description ?? '-' }}</td>
          <td class="p-3 border-t border-amber-100">
            <div class="flex gap-2">
              <a href="{{ route('attendance-histories.show', $h) }}"
                 class="rounded bg-amber-300 px-2.5 py-1 text-xs font-semibold text-slate-900 hover:bg-amber-400">
                Detail
              </a>
              <form method="post" action="{{ route('attendance-histories.destroy', $h) }}"
                    onsubmit="return confirm('Hapus history ini?')">
                @csrf @method('DELETE')
                <button class="rounded border px-2.5 py-1 text-xs text-slate-700 hover:bg-amber-50">
                  Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="p-3 text-center text-slate-600">Belum ada data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $histories->links() }}</div>
@endsection
