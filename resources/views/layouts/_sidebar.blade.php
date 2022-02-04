<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ Route::currentRouteName() == 'home' ? '' : 'collapsed' }}" href="index.html">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Master</li>


    <li class="nav-item">
      <a class="nav-link {{ Route::current()->uri == 'medicine' ? '' : 'collapsed' }}" href="{{ route('medicine.index') }}">
        <i class="fas fa-tablets"></i>
        <span>Medicine</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ Route::current()->uri == 'signa' ? '' : 'collapsed' }}" href="{{ route('signa.index') }}">
        <i class="fas fa-signature"></i>
        <span>Signa</span>
      </a>
    </li>

    <li class="nav-heading">Master</li>

    <li class="nav-item">
      <a class="nav-link {{ Route::current()->uri == 'prescription' ? '' : 'collapsed' }}" href="index.html">
        <i class="fas fa-file-prescription"></i>
        <span>Prescription</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar-->
