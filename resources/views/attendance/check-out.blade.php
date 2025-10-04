@extends('layouts.app')
@section('title','Check-out')

@section('content')
<h1 class="mb-4 text-2xl font-bold text-slate-800 text-center">
  Check-out

</h1>

<div class="flex items-center justify-center">
<div class="max-w-xl rounded-lg border border-amber-200/70 bg-white p-4 shadow-sm animate-fade-up">
  <div class="mb-4 text-sm text-slate-600">
    Waktu sekarang:
    <span class="font-medium text-slate-800">
      {{ now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') }} WIB
    </span>
  </div>

  <form method="post" action="{{ route('attendance.checkout.store') }}" class="grid gap-4">
    @csrf

    <div>
      <label class="mb-1 block text-sm text-slate-700">Karyawan</label>
      <select name="employee_id"
              class="w-full rounded-md border border-slate-300 p-2 text-sm focus:border-amber-300 focus:ring-amber-300"
              required>
        @foreach(\App\Models\Employee::orderBy('name')->get(['employee_id','name']) as $e)
          <option value="{{ $e->employee_id }}" @selected(old('employee_id')===$e->employee_id)>
            {{ $e->employee_id }} — {{ $e->name }}
          </option>
        @endforeach
      </select>
      @error('employee_id')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex gap-2">
      <button type="submit"
              class="inline-flex items-center justify-center gap-2 rounded-md bg-amber-300 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-amber-400 active:scale-[.98]">
        
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 12H10m0 0 3-3m-3 3 3 3M6 7v10"/>
        </svg>
        Check-out Sekarang
      </button>

      <a href="{{ route('attendance.logs') }}"
         class="rounded-md border px-4 py-2 text-sm text-slate-700 transition hover:bg-amber-50">
        Lihat Log
      </a>
    </div>
  </form>
</div>
</div>


<style>
  @keyframes fadeUp { from { opacity: 0; transform: translateY(6px) } to { opacity: 1; transform: translateY(0) } }
  .animate-fade-up { animation: fadeUp .45s ease both; }
</style>
@endsection
