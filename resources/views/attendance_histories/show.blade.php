@extends('layouts.app')
@section('title','Detail History')

@section('content')
<h1 class="text-xl font-semibold mb-4">Detail History</h1>

<div class="max-w-2xl border rounded p-4 bg-white">
  <dl class="grid grid-cols-3 gap-2">
    <dt class="text-sm text-slate-500">ID</dt>
    <dd class="col-span-2">{{ $history->id }}</dd>

    <dt class="text-sm text-slate-500">Employee</dt>
    <dd class="col-span-2">{{ $history->employee_id }}</dd>

    <dt class="text-sm text-slate-500">Attendance ID</dt>
    <dd class="col-span-2 font-mono">{{ $history->attendance_id }}</dd>

    <dt class="text-sm text-slate-500">Waktu</dt>
    <dd class="col-span-2">{{ $history->date_attendance }}</dd>

    <dt class="text-sm text-slate-500">Tipe</dt>
    <dd class="col-span-2">
      @if($history->attendance_type==1)
        Check-in
      @elseif($history->attendance_type==2)
        Check-out
      @else
        N/A
      @endif
    </dd>

    <dt class="text-sm text-slate-500">Deskripsi</dt>
    <dd class="col-span-2">{{ $history->description ?? '-' }}</dd>

    <dt class="text-sm text-slate-500">Dibuat</dt>
    <dd class="col-span-2">{{ $history->created_at?->format('Y-m-d H:i:s') }}</dd>

    <dt class="text-sm text-slate-500">Diubah</dt>
    <dd class="col-span-2">{{ $history->updated_at?->format('Y-m-d H:i:s') }}</dd>
  </dl>

  <div class="mt-4 flex gap-2">
    <a href="{{ route('attendance-histories.index', ['attendance_id' => $history->attendance_id]) }}"
       class="px-3 py-2 border rounded hover:bg-gray-50">Kembali ke daftar</a>
    <form method="post" action="{{ route('attendance-histories.destroy', $history) }}"
          onsubmit="return confirm('Hapus history ini?')">
      @csrf @method('DELETE')
      <button class="px-3 py-2 border rounded hover:bg-gray-50">Hapus</button>
    </form>
  </div>
</div>
@endsection
