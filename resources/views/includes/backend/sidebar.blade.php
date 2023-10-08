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
      <a class="nav-link @if (Request::segment(1) != 'purchases') collapsed  @endif" href="{{route('admin.dashboard')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Purchases</span>
      </a>
    </li><!-- End purchases Page Nav -->
    @endrole



    {{-- ----Sales---- --}}
    @role('Sales')
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(1) != 'sales') collapsed  @endif" href="{{route('sales.index')}}">
        <i class="bi bi-card-checklist"></i>
        <span>Penjualan</span>
      </a>
    </li><!-- End purchases Page Nav -->
    @endrole
    

    {{-- ----Purchases---- --}}
    @role('Purchases')
    <li class="nav-item">
      {{-- <a class="nav-link @if (Request::segment(1) != 'purchases') collapsed  @endif" href="{{route('purchases.index')}}"> --}}
        <i class="bi bi-card-checklist"></i>
        <span>Purchases</span>
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