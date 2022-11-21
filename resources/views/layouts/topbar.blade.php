<nav class="navbar">
    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">English</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="languageDropdown">
            <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
            <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-id" title="fr" id="fr"></i> <span class="ms-1"> Indonesian </span></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i data-feather="grid"></i>
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
              <p class="mb-0 fw-bold">Web Apps</p>
              <a href="javascript:;" class="text-muted">Edit</a>
            </div>
            <div class="row g-0 p-1">
              <div class="col-3 text-center">
                <a href="pages/apps/chat.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                  ><i data-feather="message-square" class="icon-lg mb-1"></i>
                  <p class="tx-12">Chat</p></a
                >
              </div>
              <div class="col-3 text-center">
                <a href="pages/apps/calendar.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                  ><i data-feather="calendar" class="icon-lg mb-1"></i>
                  <p class="tx-12">Calendar</p></a
                >
              </div>
              <div class="col-3 text-center">
                <a href="pages/email/inbox.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                  ><i data-feather="mail" class="icon-lg mb-1"></i>
                  <p class="tx-12">Email</p></a
                >
              </div>
              <div class="col-3 text-center">
                <a href="pages/general/profile.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                  ><i data-feather="instagram" class="icon-lg mb-1"></i>
                  <p class="tx-12">Profile</p></a
                >
              </div>
            </div>
            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
              <a href="javascript:;">View all</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('messages.index')}}">
            <i data-feather="mail"></i>
          </a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile" />
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
              <div class="mb-3">
                <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="" />
              </div>
              <div class="text-center">
                <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
              </div>
            </div>
            <ul class="list-unstyled p-1">
              <li class="dropdown-item py-2">
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
              </li>
             
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