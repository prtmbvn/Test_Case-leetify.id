@extends('layouts.app')
@section('title','Detail History')

@section('content')
<h1 class="mb-4 text-2xl font-bold text-slate-800 text-center">
  Detail History
</h1>

<div class="flex items-center justify-center">
  <div class="max-w-2xl rounded-lg border border-amber-200/70 bg-white p-4 shadow-sm md:p-6 ">
  <dl class="grid grid-cols-3 gap-x-3">
    <dt class="py-2.5 text-sm text-slate-500">ID</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5 font-mono text-[13px] md:border-0">
      {{ $history->id }}
    </dd>

    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Employee</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      <span class="font-medium text-slate-800">{{ $history->employee_id }}</span>
    </dd>

    
    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Attendance ID</dt>
    <dd class="col-span-2 flex items-center gap-2 border-t border-amber-100 py-2.5">
      <span id="attendanceId" class="font-mono text-[13px] break-all">{{ $history->attendance_id }}</span>
    </dd>

    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Waktu</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      {{ $history->date_attendance }}
    </dd>

   
    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Tipe</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      @if($history->attendance_type==1)
        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-800">Check-in</span>
      @elseif($history->attendance_type==2)
        <span class="inline-flex items-center rounded-full border border-sky-200 bg-sky-50 px-2.5 py-0.5 text-xs font-semibold text-sky-800">Check-out</span>
      @else
        <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-semibold text-slate-700">N/A</span>
      @endif
    </dd>

    
    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Deskripsi</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      {{ $history->description ?? '-' }}
    </dd>

    
    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Dibuat</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      {{ $history->created_at?->format('Y-m-d H:i:s') }}
    </dd>

    <dt class="border-t border-amber-100 py-2.5 text-sm text-slate-500">Diubah</dt>
    <dd class="col-span-2 border-t border-amber-100 py-2.5">
      {{ $history->updated_at?->format('Y-m-d H:i:s') }}
    </dd>
  </dl>

  <div class="mt-5 flex gap-2">
    <a href="{{ route('attendance-histories.index', ['attendance_id' => $history->attendance_id]) }}"
       class="rounded bg-amber-300 px-3 py-2 text-sm font-semibold text-slate-900 hover:bg-amber-400">
      Kembali ke daftar
    </a>
    <form method="post" action="{{ route('attendance-histories.destroy', $history) }}"
          onsubmit="return confirm('Hapus history ini?')">
      @csrf @method('DELETE')
      <button class="rounded border px-3 py-2 text-sm text-slate-700 hover:bg-amber-50">
        Hapus
      </button>
    </form>
  </div>
  </div>
</div>
@endsection
