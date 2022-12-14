<nav class="navbar">
    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('messages.index')}}">
            <i data-feather="mail"></i>
          </a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="{{asset('template/profile.png')}}" alt="profile" />
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
              <div class="mb-3">
                <img class="wd-80 ht-80 rounded-circle" src="{{asset('template/profile.png')}}" alt="" />
              </div>
              <div class="text-center">
                <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
              </div>
            </div>
            <ul class="list-unstyled p-1">
              {{-- <li class="dropdown-item py-2">
                <a href="pages/general/profile.html" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="user"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="dropdown-item py-2">
                <a href="javascript:;" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="edit"></i>
                  <span>Edit Profile</span>
                </a>
              </li> --}}
             
              <div class="d-flex align-item-center justify-content-center px-5 py-3">
              
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                      <button class="btn btn-primary">
                          <i class="me-2 icon-md" data-feather="log-out"></i>
                          <span>Log Out</span>
                      </button>
                  </form>
              
              </div>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav>