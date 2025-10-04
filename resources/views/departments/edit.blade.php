@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<h1 class="text-4xl font-semibold mb-4 text-center">Edit Departemen</h1>

<form method="post" action="{{ route('departments.update', $department) }}" class="max-w-xl">
  @csrf @method('PUT')
  @include('departments._form', ['department' => $department, 'submitText' => 'Update'])
</form>
@endsection
