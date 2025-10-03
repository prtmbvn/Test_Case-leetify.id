<footer class="mt-16 border-t border-slate-200 bg-white">
  <div class="mx-auto max-w-6xl px-4 py-10 grid gap-8 sm:grid-cols-3">
    <div>
      <div class="flex items-center gap-2 font-semibold text-slate-900 mb-2">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 14h-2v-2h2Zm0-4h-2V6h2Z"/></svg>
        Fleetify Attendance
      </div>
      <p class="text-sm text-slate-600">
        Sistem absensi sederhana untuk mencatat ketepatan waktu karyawan berdasarkan jam maksimal tiap departemen.
      </p>
    </div>

    <div>
      <h3 class="text-sm font-semibold text-slate-900 mb-3">Navigasi</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="{{ route('home') }}" class="text-slate-600 hover:text-slate-900">Home</a></li>
        <li><a href="{{ route('attendance.logs') }}" class="text-slate-600 hover:text-slate-900">Logs</a></li>
        <li><a href="{{ route('attendance.checkin.form') }}" class="text-slate-600 hover:text-slate-900">Check-in</a></li>
        <li><a href="{{ route('attendance.checkout.form') }}" class="text-slate-600 hover:text-slate-900">Check-out</a></li>
        <li><a href="{{ route('departments.index') }}" class="text-slate-600 hover:text-slate-900">Departments</a></li>
        <li><a href="{{ route('employees.index') }}" class="text-slate-600 hover:text-slate-900">Employees</a></li>
      </ul>
    </div>

    <div>
      <h3 class="text-sm font-semibold text-slate-900 mb-3">Info</h3>
      <ul class="space-y-2 text-sm text-slate-600">
        <li>Timezone: Asia/Jakarta</li>
        <li>Stack: Laravel + MySQL + Tailwind</li>
        <li>© {{ date('Y') }} Fleetify</li>
      </ul>
    </div>
  </div>

  <div class="border-t border-slate-200">
    <div class="mx-auto max-w-6xl px-4 py-4 text-xs text-slate-500 flex items-center justify-between">
      <p>© {{ date('Y') }} Fleetify Attendance. All rights reserved.</p>
      <p>Made with ♥ using Laravel</p>
    </div>
  </div>
</footer>
