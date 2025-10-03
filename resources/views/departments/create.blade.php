@extends('layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
<h1 class="text-xl font-semibold mb-4">Tambah Departemen</h1>

<form method="post" action="{{ route('departments.store') }}">
  @csrf
  @include('departments._form', ['department' => null, 'submitText' => 'Simpan'])
</form>
@endsection
