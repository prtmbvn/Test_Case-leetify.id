@extends('layouts.app')
@section('title','Attendance History')

@section('content')
<h1 class="text-xl font-semibold mb-4">Attendance History</h1>

<form method="get" class="flex flex-wrap gap-2 mb-4">
  <input type="text" name="employee_id" value="{{ request('employee_id') }}" placeholder="EMP-001"
         class="border p-2 rounded">
  <input type="text" name="attendance_id" value="{{ request('attendance_id') }}" placeholder="UUID attendance"
         class="border p-2 rounded">
  <select name="type" class="border p-2 rounded">
    <option value="">— Tipe —</option>
    <option value="1" @selected(request('type')==='1')>Check-in</option>
    <option value="2" @selected(request('type')==='2')>Check-out</option>
  </select>
  <input type="date" name="date_from" value="{{ request('date_from') }}" class="border p-2 rounded">
  <input type="date" name="date_to"   value="{{ request('date_to')   }}" class="border p-2 rounded">
  <button class="px-4 py-2 border rounded hover:bg-gray-50">Filter</button>
  @if(request()->hasAny(['employee_id','attendance_id','type','date_from','date_to']))
    <a href="{{ route('attendance-histories.index') }}" class="px-2 py-2 text-sm">Reset</a>
  @endif
</form>

<div class="overflow-x-auto rounded border shadow-sm">
  <table class="w-full min-w-[900px] text-sm">
    <thead>
      <tr class="bg-gray-100">
        <th class="p-3 border">Waktu</th>
        <th class="p-3 border">Employee</th>
        <th class="p-3 border">Attendance ID</th>
        <th class="p-3 border">Tipe</th>
        <th class="p-3 border">Deskripsi</th>
        <th class="p-3 border w-28">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($histories as $h)
        <tr class="hover:bg-gray-50">
          <td class="p-3 border">{{ $h->date_attendance }}</td>
          <td class="p-3 border">{{ $h->employee_id }}</td>
          <td class="p-3 border font-mono">{{ $h->attendance_id }}</td>
          <td class="p-3 border">
            @if($h->attendance_type==1)
              <span class="inline-flex items-center px-2 py-0.5 rounded bg-green-100 text-green-700 text-xs">IN</span>
            @elseif($h->attendance_type==2)
              <span class="inline-flex items-center px-2 py-0.5 rounded bg-blue-100 text-blue-700 text-xs">OUT</span>
            @else
              <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-700 text-xs">N/A</span>
            @endif
          </td>
          <td class="p-3 border">{{ $h->description ?? '-' }}</td>
          <td class="p-3 border">
            <div class="flex gap-2">
              <a href="{{ route('attendance-histories.show', $h) }}"
                 class="px-2 py-1 border rounded text-xs hover:bg-gray-50">Detail</a>
              <form method="post" action="{{ route('attendance-histories.destroy', $h) }}"
                    onsubmit="return confirm('Hapus history ini?')">
                @csrf @method('DELETE')
                <button class="px-2 py-1 border rounded text-xs hover:bg-gray-50">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="p-3 border text-center text-slate-500">Belum ada data</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $histories->links() }}</div>
@endsection
