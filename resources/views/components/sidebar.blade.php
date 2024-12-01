  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('') }}dist/img/POSMateLogo.png" alt="AdminLTE Logo" class="brand-image"
              style="opacity: .8">
          <span class="brand-text font-weight-light">POSMate</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              @if (Auth::user()->profile_picture)
                  <div class="image">
                      <img src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                          class="img-circle elevation-2 profile-image" alt="User-Image">
                  </div>
              @else
                  <div class="image">
                      <img src="{{ asset('uploads/profile_pictures/default.png') }}"
                          class="img-circle elevation-2 profile-image" alt="User-Image">
                  </div>
              @endif
              <div class="info">
                  <a href="{{ route('profile.edit', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-chart-line"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('produk.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-cube"></i>
                          <p>
                              Produk
                              @if ($produkBaru)
                                  <span class="right badge badge-danger">Baru</span>
                              @endif
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('penjualan.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-shopping-cart"></i>
                          <p>
                              Penjualan
                              @if ($penjualanBaru)
                                  <span class="right badge badge-danger">Baru</span>
                              @endif
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('produk.logproduk') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Log Produk
                              @if ($logStokBaru)
                                  <span class="right badge badge-danger">Baru</span>
                              @endif
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('logout') }}" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
