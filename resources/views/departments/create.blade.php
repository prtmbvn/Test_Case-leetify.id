@extends('layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
<h1 class="text-4xl font-bold mb-4 text-center">Tambah Departemen</h1>

<form method="post" action="{{ route('departments.store') }}">
  @csrf
  @include('departments._form', ['department' => null, 'submitText' => 'Simpan'])
</form>
@endsection
