@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<h1 class="text-xl font-semibold mb-4">Edit Departemen</h1>

<form method="post" action="{{ route('departments.update', $department) }}" class="max-w-xl">
  @csrf @method('PUT')
  @include('departments._form', ['department' => $department, 'submitText' => 'Update'])
</form>
@endsection
