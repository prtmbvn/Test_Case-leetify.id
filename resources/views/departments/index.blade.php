@extends('layouts.app')
@section('title', 'Departments')
@section('content')


<div class="flex items-center">
  <h1 class="text-xl font-semibold">Departments</h1>
</div>

<div class="mt-10">
    <form method="get" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama departemen"
            class="border p-2 rounded w-64">
    <button class="px-4 py-2 border rounded hover:bg-gray-50 ml-2">Filter</button>
    @if(request()->filled('search'))
        <a href="{{ route('departments.index') }}" class="ml-2 text-sm hover:underline">Reset</a>
    @endif
    <a href="{{ route('departments.create') }}" class="px-3 py-2 border rounded hover:bg-gray-50">+ Tambah</a>
    </form>
</div>

<div class="overflow-x-auto ">
  <table class="w-full border  ">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-5 border">Nama</th>
        <th class="p-5 border">Max In</th>
        <th class="p-5 border">Max Out</th>
        <th class="p-5 border w-40">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($departments as $d)
        <tr>
          <td class="p-2 border">{{ $d->department_name }}</td>
          <td class="p-2 border">{{ $d->max_clock_in_time, 0, 5 }}</td>
          <td class="p-2 border">{{ $d->max_clock_out_time, 0, 5 }}</td>
          <td class="p-2 border">
            <div class="flex gap-2">
              <a href="{{ route('departments.edit', $d) }}" class="px-2 py-1 border rounded text-sm hover:bg-gray-50">Edit</a>
              <form action="{{ route('departments.destroy', $d) }}" method="post"
                    onsubmit="return confirm('Hapus departemen {{ $d->department_name }}?')">
                @csrf @method('DELETE')
                <button class="px-2 py-1 border rounded text-sm hover:bg-gray-50">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="p-2 border text-center text-slate-500">Belum ada data</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-3">{{ $departments->links() }}</div>
@endsection
