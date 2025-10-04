@extends('layouts.app')
@section('title', 'Edit Karyawan')

@section('content')
<h1 class="text-4xl mb-4 text-center font-bold ">Edit Karyawan</h1>

<form method="post" action="{{ route('employees.update', $employee) }}" class="max-w-xl">
  @csrf
  @method('PUT')
  @include('employees._form', ['employee' => $employee, 'submitText' => 'Update'])
</form>
@endsection
