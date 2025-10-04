@extends('layouts.app')
@section('content')
<section class="w-full h-full py-28">
    <h1 class="text-center font-bold text-5xl mt-16">Welcome To <span class="text-amber-300 italic">Fleetify</span> Attendance</h1>
    <div class="flex flex-row gap-10 items-center justify-center py-20">
        <a href="{{ route('attendance.checkin.form') }}" class="border py-2 px-10 rounded-4xl bg-amber-300 font-bold">Check in</a>
        <a href="{{ route('attendance.checkout.form') }}" class="border py-2 px-10 rounded-4xl bg-amber-300 font-bold">Check out</a>
    </div>
</section>
@stop
