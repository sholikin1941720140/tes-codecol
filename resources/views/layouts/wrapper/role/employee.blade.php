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
      <a href="{{ url('/admin/jadwal') }}"
         class="nav-link {{ Request::segment(1) == 'absensi' && Request::segment(2) == 'dosen' ? 'active' : '' }}">
         <i class="fas fa-money-bill-wave-alt"></i>
         <p>&nbsp; Jadwal</p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{url('/user')}}"
         class="nav-link {{Request::segment(1) == 'user' ? 'active' : ''}}">
         <i class="fa-solid fa-clipboard-user"></i>
         <p> &nbsp;
            Absensi
         </p>
      </a>
   </li>

   <li class="nav-item">
      <a href="{{ url('/admin/laporan') }}"
         class="nav-link {{ Request::segment(1) == 'absensi' && Request::segment(2) == 'dosen' ? 'active' : '' }}">
         <i class="fas fa-calendar-check"></i>
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
