<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('dashboard.index')}}" class="sidebar-brand"> Madjou <span>Web</span> </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Utama</li>
          <li class="nav-item">
            <a href="{{ route('dashboard.index')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item nav-category">Notifikasi dan langganan</li>
          
          <li class="nav-item">
            <a href="{{route('notifications.index')}}" class="nav-link">
              <i class="link-icon" data-feather="message-square"></i>
              <span class="link-title">Notifikasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('subscribes.index')}}" class="nav-link">
              <i class="link-icon" data-feather="bell"></i>
              <span class="link-title">Langganan</span>
            </a>
          </li>

          <li class="nav-item nav-category">Layanan</li>

          <li class="nav-item">
            <a href="{{ route('services.index')}}" class="nav-link">
              <i class="link-icon" data-feather="tool"></i>
              <span class="link-title">Layanan</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('detail-services.index')}}" class="nav-link">
              <i class="link-icon" data-feather="bell"></i>
              <span class="link-title">Detail layanan</span>
            </a>
          </li>
          
          <li class="nav-item nav-category">Projek</li>
          <li class="nav-item">
            <a href="{{ route('project-types.index')}}" class="nav-link">
              <i class="link-icon" data-feather="codepen"></i>
              <span class="link-title">Jenis projek</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('project.index')}}" class="nav-link">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">Data projek</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('clients.index')}}" class="nav-link">
              <i class="link-icon" data-feather="smile"></i>
              <span class="link-title">Klien kami</span>
            </a>
          </li>
          <li class="nav-item nav-category">Blogs</li>
          <li class="nav-item">
            <a href="{{ route('category-blogs.index')}}" class="nav-link">
              <i class="link-icon" data-feather="grid"></i>
              <span class="link-title">Kategori blog</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('blogs.index')}}" class="nav-link">
              <i class="link-icon" data-feather="book-open"></i>
              <span class="link-title">Data blog</span>
            </a>
          </li>
          <li class="nav-item nav-category">Karir</li>
          <li class="nav-item">
            <a href="{{route('careers.index')}}" class="nav-link">
              <i class="link-icon" data-feather="dollar-sign"></i>
              <span class="link-title">Data karir</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employees.index')}}" class="nav-link">
              <i class="link-icon" data-feather="user-check"></i>
              <span class="link-title">Pendaftaran karyawan</span>
            </a>
          </li>
          <li class="nav-item nav-category">Teams</li>
          <li class="nav-item">
            <a href="{{ route('category-teams.index')}}" class="nav-link">
              <i class="link-icon" data-feather="user-plus"></i>
              <span class="link-title">Kategori team</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('teams.index')}}" class="nav-link">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">Data team</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('languages.index')}}" class="nav-link">
              <i class="link-icon" data-feather="bookmark"></i>
              <span class="link-title">Bahasa pemrograman</span>
            </a>
          </li>
          <li class="nav-item nav-category">Menu Super-Admin</li>
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Master User</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('roles.index')}}" class="nav-link">
              <i class="link-icon" data-feather="lock"></i>
              <span class="link-title">Role & Privilage</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tags.index')}}" class="nav-link">
              <i class="link-icon" data-feather="tag"></i>
              <span class="link-title">Tags</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('settings.index')}}" class="nav-link">
              <i class="link-icon" data-feather="settings"></i>
              <span class="link-title">Settings</span>
            </a>
          </li>
        </ul>
      </div>
</nav>
{{-- end sidebar --}}

  <!-- partial -->

 
    <!-- partial:partials/_navbar.html -->
  
    <!-- partial -->