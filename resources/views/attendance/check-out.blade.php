@extends('layouts.app')
@section('title','Check-out')

@section('content')
<h1 class="text-xl font-semibold mb-4">Check-out</h1>

<form method="post" action="{{ route('attendance.checkout.store') }}" class="grid gap-4 max-w-xl">
  @csrf
  <div>
    <label class="block text-sm mb-1">Karyawan</label>
    <select name="employee_id" class="border p-2 rounded w-full" required>
      @foreach(\App\Models\Employee::orderBy('name')->get(['employee_id','name']) as $e)
        <option value="{{ $e->employee_id }}">{{ $e->employee_id }} — {{ $e->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="flex gap-2">
    <button class="px-4 py-2 border rounded hover:bg-gray-50">Check-out Sekarang</button>
    <a href="{{ route('attendance.logs') }}" class="px-4 py-2 border rounded hover:bg-gray-50">Lihat Log</a>
  </div>
</form>
@endsection
