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
      <a href="{{ url('/schedule') }}"
         class="nav-link {{ Request::segment(1) == 'schedule' ? 'active' : '' }}">
         <i class="fas fa-calendar-alt"></i>
         <p>&nbsp; Jadwal</p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ url('/report') }}"
         class="nav-link {{ Request::segment(1) == 'report' ? 'active' : '' }}">
         <i class="fas fa-clipboard-list"></i>
         <p>&nbsp; Laporan Absensi</p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{url('/user')}}"
         class="nav-link {{Request::segment(1) == 'user' ? 'active' : ''}}">
         <i class="fas fa-user-plus"></i>
         <p> &nbsp;
            User
         </p>
      </a>
   </li>
</ul>

<style>
   .nav-sidebar .nav-item > .nav-link.active, .nav-treeview > .nav-item > .nav-link.active {
      background-color: #007bff !important;
      color: white;
   }
</style>
