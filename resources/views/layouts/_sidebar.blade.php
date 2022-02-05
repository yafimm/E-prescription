<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ Route::currentRouteName() == 'home' ? '' : 'collapsed' }}" href="{{ route('home') }}">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Master</li>


    <li class="nav-item">
      <a class="nav-link {{ Route::is('medicine*') ? '' : 'collapsed' }}" href="{{ route('medicine.index') }}">
        <i class="fas fa-tablets"></i>
        <span>Medicine</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ Route::is('signa*') ? '' : 'collapsed' }}" href="{{ route('signa.index') }}">
        <i class="fas fa-signature"></i>
        <span>Signa</span>
      </a>
    </li>

    <li class="nav-heading">Transaction</li>

    <li class="nav-item">
      <a class="nav-link {{ Route::is('prescription*') ? '' : 'collapsed' }}" href="{{ route('prescription.index') }}">
        <i class="fas fa-file-prescription"></i>
        <span>Prescription</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar-->
