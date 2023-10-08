<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    @role('SuperAdmin')
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) != 'admin') collapsed  @endif" href="{{route('admin.dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Manage User</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('admin.user.index')}}">
            <i class="bi bi-circle"></i><span>Data User</span>
          </a>
        </li>   
        
        <li>
          <a href="{{route('admin.role.index')}}">
            <i class="bi bi-circle"></i><span>Hak akses User</span>
          </a>
        </li>  
      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) != 'inventory') collapsed  @endif" href="{{route('admin.inventory.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Inventory</span>
      </a>
    </li><!-- End purchases Page Nav -->

    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) != 'sales') collapsed  @endif" href="{{route('admin.sales.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Penjualan</span>
      </a>
    </li><!-- End purchases Page Nav -->

    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) != 'purchase') collapsed  @endif" href="{{route('admin.purchase.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Pembelian</span>
      </a>
    </li><!-- End purchases Page Nav -->
    @endrole



    {{-- ----Sales---- --}}
    @role('Sales')
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(1) != 'sales') collapsed  @endif" href="{{route('sales.sales.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Penjualan</span>
      </a>
    </li><!-- End purchases Page Nav -->
    @endrole
    

    {{-- ----Purchases---- --}}
    @role('Purchase')
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) != 'purchase') collapsed  @endif" href="{{route('purchases.purchase.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Pembelian</span>
      </a>
    </li><!-- End purchases Page Nav -->
    @endrole
    

    {{-- ----Manager---- --}}
    @role('Manager')
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(1) != 'admin') collapsed  @endif" href="{{route('admin.dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->        
    @endrole

  </ul>

</aside><!-- End Sidebar-->