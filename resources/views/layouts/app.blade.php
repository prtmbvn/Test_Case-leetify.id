<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Fleetify Attendance')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  @stack('styles')
</head>
{{-- tambahkan flex & flex-col --}}
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900">
  {{-- Navbar --}}
  @include('includes.navbar')

  {{-- jadikan main fleksibel supaya mengisi ruang kosong --}}
  <main class="flex-1 px-4 py-6">
    @if ($errors->any())
      <div class="mb-4 rounded-lg bg-red-50 p-3 text-sm text-red-700">
        {{ $errors->first() }}
      </div>
    @endif
    @if (session('ok'))
      <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-700">
        {{ session('ok') }}
      </div>
    @endif

    @yield('content')
  </main>

  {{-- Footer: dorong ke bawah dengan mt-auto --}}
  <div class="mt-auto">
    @include('includes.footer')
  </div>

  @stack('scripts')
</body>
</html>
