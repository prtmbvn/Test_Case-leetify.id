@extends('layouts.app')
@section('title', 'Departments')

@section('content')
<div class="rounded-xl border border-amber-200 bg-amber-300 p-5 mb-6">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-amber-900">Departments</h1>
    </div>
    <a href="{{ route('departments.create') }}"
       class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-gradient-to-br from-amber-50 to-white px-4 py-2 text-amber-900 font-medium hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-1">
      <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V6h2v5h5v2h-5v5h-2v-5H6v-2z"/></svg>
      Tambah
    </a>
  </div>
</div>


<form method="get" class="mb-5">
  <div class="flex flex-wrap items-end gap-3">
    <div>
      <label class="block text-xs text-slate-500 mb-1">Cari nama departemen</label>
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Human Resource"
             class="w-64 rounded-lg border border-amber-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-300">
    </div>
    <div class="flex gap-2">
      <button class="rounded-lg border border-amber-300 bg-amber-300/90 px-4 py-2 text-amber-900 hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400">
        Filter
      </button>
      @if(request()->filled('search'))
        <a href="{{ route('departments.index') }}"
           class="rounded-lg border px-4 py-2 hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-300">
          Reset
        </a>
      @endif
    </div>
  </div>
</form>

{{-- Table --}}
<div class="overflow-x-auto rounded-xl border shadow-sm">
  <table class="w-full min-w-[820px]">
    <thead>
      <tr class="bg-amber-300 border-b">
        <th class="p-4 text-left text-amber-900/90">Nama</th>
        <th class="p-4 text-left text-amber-900/90">Max In</th>
        <th class="p-4 text-left text-amber-900/90">Max Out</th>
        <th class="p-4 text-left text-amber-900/90 w-40">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y">
      @forelse($departments as $d)
        <tr class="hover:bg-amber-50/40">
          <td class="p-4">
            <span class="inline-flex items-center rounded-md bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-900">
              {{ $d->department_name }}
            </span>
          </td>
          <td class="p-4">{{ $d->max_clock_in_time_only }}</td>
          <td class="p-4">{{ $d->max_clock_out_time_only }}</td>

          <td class="p-4">
            <div class="flex gap-2">
              <a href="{{ route('departments.edit', $d) }}"
                 class="rounded-md border px-3 py-1.5 text-sm hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-300">
                Edit
              </a>
              <form action="{{ route('departments.destroy', $d) }}" method="post"
                    onsubmit="return confirm('Hapus departemen {{ $d->department_name }}?')">
                @csrf @method('DELETE')
                <button
                  class="rounded-md border px-3 py-1.5 text-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-300">
                  Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="p-8 text-center">
            <div class="inline-flex items-center gap-3 rounded-lg border border-dashed border-amber-200 bg-amber-50/40 px-5 py-4">
              <svg class="h-5 w-5 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2ZM11 11V7h2v4h4v2h-4v4h-2v-4H7v-2Z"/></svg>
              <span class="text-sm text-amber-900/90">Belum ada data departemen.</span>
              <a href="{{ route('departments.create') }}" class="text-sm font-medium text-amber-800 hover:underline">Tambah sekarang</a>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $departments->links() }}</div>
@endsection
