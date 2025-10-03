<nav class="sticky top-0 inset-x-0 z-50 bg-white/70 backdrop-blur border-b border-slate-200">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex h-14 items-center justify-between">
      {{-- Brand --}}
      <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold text-slate-900">
        {{-- Logo kecil (opsional) --}}
        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 14h-2v-2h2Zm0-4h-2V6h2Z"/></svg>
        Fleetify Attendance
      </a>

      {{-- Toggle mobile --}}
      <button class="lg:hidden inline-flex items-center justify-center rounded-md border border-slate-300 px-2.5 py-2 text-slate-700"
              type="button" id="nav-toggle" aria-expanded="false" aria-controls="nav-mobile">
        <span class="sr-only">Toggle navigation</span>
        <svg id="icon-hamburger" class="h-5 w-5 block" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
        <svg id="icon-close" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.42L10.59 13.4 4.29 19.71 2.88 18.3 9.17 12 2.88 5.71 4.29 4.29 10.59 10.6l6.3-6.31z"/></svg>
      </button>

      {{-- Desktop menu --}}
      <ul class="hidden lg:flex items-center gap-6 text-sm">
        <li class="border-b-2 {{ request()->routeIs('attendance.logs') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('attendance.logs') }}" class="{{ request()->routeIs('attendance.logs') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Logs</a>
        </li>

        <li class="relative group">
          <button type="button"
                  class="inline-flex items-center gap-1 text-slate-600 hover:text-slate-900 border-b-2 border-transparent group-hover:border-slate-300">
            Attendance
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
          </button>
          <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition
                      absolute left-0 mt-2 w-40 rounded-lg border border-slate-200 bg-white shadow-lg">
            <a href="{{ route('attendance.checkin.form') }}" class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">Check-in</a>
            <a href="{{ route('attendance.checkout.form') }}" class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">Check-out</a>
          </div>
        </li>

        <li class="border-b-2 {{ request()->is('departments*') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('departments.index') }}" class="{{ request()->is('departments*') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Departments</a>
        </li>
        <li class="border-b-2 {{ request()->is('employees*') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('employees.index') }}" class="{{ request()->is('employees*') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Employees</a>
        </li>
      </ul>
    </div>

    {{-- Mobile menu --}}
    <div id="nav-mobile" class="lg:hidden hidden border-t border-slate-200 py-2">
      <div class="flex flex-col py-1 text-sm">
        <a href="{{ route('attendance.logs') }}" class="px-2 py-2 text-slate-700 hover:bg-slate-50 rounded">Logs</a>
        <a href="{{ route('attendance.checkin.form') }}" class="px-2 py-2 text-slate-700 hover:bg-slate-50 rounded">Check-in</a>
        <a href="{{ route('attendance.checkout.form') }}" class="px-2 py-2 text-slate-700 hover:bg-slate-50 rounded">Check-out</a>
        <a href="{{ route('departments.index') }}" class="px-2 py-2 text-slate-700 hover:bg-slate-50 rounded">Departments</a>
        <a href="{{ route('employees.index') }}" class="px-2 py-2 text-slate-700 hover:bg-slate-50 rounded">Employees</a>
      </div>
    </div>
  </div>
</nav>

{{-- Script kecil untuk toggle mobile menu (tanpa library) --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('nav-toggle');
    const mobile = document.getElementById('nav-mobile');
    const iconBurger = document.getElementById('icon-hamburger');
    const iconClose  = document.getElementById('icon-close');
    if (!btn || !mobile) return;

    btn.addEventListener('click', () => {
      const open = mobile.classList.toggle('hidden') === false;
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (iconBurger && iconClose) {
        iconBurger.classList.toggle('hidden', open);
        iconClose.classList.toggle('hidden', !open);
      }
    });
  });
</script>
