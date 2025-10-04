@extends('layouts.app')
@section('title', 'Tambah Karyawan')

@section('content')
<h1 class="text-4xl mb-4 text-center font-bold ">Tambah Karyawan</h1>
<form method="post" action="{{ route('employees.store') }}" class="max-w-xl">
  @csrf
  @include('employees._form', ['employee' => null, 'submitText' => 'Simpan'])
</form>
@endsection
