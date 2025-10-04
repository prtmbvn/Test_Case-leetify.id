<nav class="sticky top-0 inset-x-0 z-50 bg-white/70 backdrop-blur border-b border-slate-200">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex h-14 items-center justify-between">
      
      <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold text-slate-900">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 14h-2v-2h2Zm0-4h-2V6h2Z"/></svg>
        Fleetify Attendance
      </a>

      <button class="lg:hidden inline-flex items-center justify-center rounded-md border border-slate-300 px-2.5 py-2 text-slate-700"
              type="button" id="nav-toggle" aria-expanded="false" aria-controls="nav-mobile">
        <span class="sr-only">Toggle navigation</span>
        <svg id="icon-hamburger" class="h-5 w-5 block" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
        <svg id="icon-close" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M18.3 5.71 12 12l6.3 6.29-1.41 1.42L10.59 13.4 4.29 19.71 2.88 18.3 9.17 12 2.88 5.71 4.29 4.29 10.59 10.6l6.3-6.31z"/></svg>
      </button>

      <ul class="hidden lg:flex items-center gap-6 text-sm">
        <li class="border-b-2 {{ request()->routeIs('attendance.logs') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('attendance.logs') }}" class="{{ request()->routeIs('attendance.logs') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Logs</a>
        </li>
        <li class="border-b-2 {{ request()->routeIs('attendance-histories.*') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('attendance-histories.index') }}" class="{{ request()->routeIs('attendance-histories.*') ? 'text-slate-600 font-medium' : 'text-slate-600 hover:text-slate-900' }}">
              Attendance Histories
          </a>
        </li>
        <li class="border-b-2 {{ request()->is('departments*') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('departments.index') }}" class="{{ request()->is('departments*') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Departments</a>
        </li>
        
        <li class="border-b-2 {{ request()->is('employees*') ? 'border-slate-900' : 'border-transparent hover:border-slate-300' }}">
          <a href="{{ route('employees.index') }}" class="{{ request()->is('employees*') ? 'text-slate-900 font-medium' : 'text-slate-600 hover:text-slate-900' }}">Employees</a>
        </li>
      </ul>
    </div>
</nav>


