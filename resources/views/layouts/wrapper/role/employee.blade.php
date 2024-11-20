<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" 
   data-accordion="false">
   <li class="nav-item">
      <a href="{{url('/dashboard')}}"
         class="nav-link {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
         <i class="fas fa-home"></i>
         <p> &nbsp;
            Dashboard
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ url('/employee-schedule') }}"
         class="nav-link {{ Request::segment(1) == 'employee-schedule' ? 'active' : '' }}">
         <i class="fas fa-calendar-alt"></i>
         <p>&nbsp; Jadwal</p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{url('/employee-attendance')}}"
         class="nav-link {{Request::segment(1) == 'employee-attendance' ? 'active' : ''}}">
         <i class="fas fa-calendar-check"></i>
         <p> &nbsp; Absensi </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ url('/employee-report') }}"
         class="nav-link {{ Request::segment(1) == 'employee-report' ? 'active' : '' }}">
         <i class="fas fa-clipboard-list"></i>
         <p>&nbsp; Laporan Absensi</p>
      </a>
   </li>
</ul>

<style>
   .nav-sidebar .nav-item > .nav-link.active, .nav-treeview > .nav-item > .nav-link.active {
      background-color: #007bff !important;
      color: white;
   }
</style>
