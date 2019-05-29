<style>
  .nav-item {
    direction:ltr;
  }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav" style="position: fixed;
    direction:rtl;
    overflow: auto;
    height: calc(100vh - 63px);
    width: 295px;
    padding-bottom: 3.5rem;
    ">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ asset('images/faces/boy.png') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ Auth::user()->name }}</p>
            <div>
              <small class="designation text-muted">Jendela Jakarta</small>
            </div>
            <div class="mt-2"><span class="designation text-dark">Online</span><span class="status-indicator online"></span>
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-block">Buat Post
          <i class="mdi mdi-plus"></i>
        </button>
        <button class="btn btn-warning btn-block">Attend!
        </button>
      </div>
    </li>
    @php
    $listMenu = \App\Models\Menu::buildTree();
    @endphp
    @foreach($listMenu as $menu)
      @isset($menu['children'])
      <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu{{$menu['id']}}"
         aria-expanded="false" aria-controls="menu1">
        <i class="menu-icon {{$menu['icon']}}"></i>
        <span class="menu-title">{{$menu['text']}}</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu{{$menu['id']}}">
        <ul class="nav flex-column sub-menu">
          @foreach($menu['children'] as $submenu)
            <li class="nav-item">
              <a class="nav-link" href="{{ route($submenu['route']) }}">{{$submenu['text']}}</a>
            </li>
          @endforeach
        </ul>
      </div>
    </li>
    @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route($menu['route']) }}">
          <i class="menu-icon {{ $menu['icon'] }}"></i>
          <span class="menu-title">{{ $menu['text'] }}</span>
        </a>
      </li>
    @endisset
    @endforeach
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.relawan.index') }}">
        <i class="menu-icon mdi mdi-web"></i>
        <span class="menu-title">Website</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu1" aria-expanded="false" aria-controls="menu1">
        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
        <span class="menu-title">Students</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.student.statistic') }}">Student Statistic</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.student-attendance.index') }}">Attending Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.student.index') }}">Manage Student</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu2" aria-expanded="false" aria-controls="menu2">
        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
        <span class="menu-title">Volunteers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.relawan.statistic') }}">Volunteers Statistic</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.relawan.index') }}">Manage Volunteers</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menuAttendance" aria-expanded="false" aria-controls="menu3">
        <i class="menu-icon mdi mdi-clock"></i>
        <span class="menu-title">Attendance</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuAttendance">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.volunteer-attendance.index') }}">Attending Volunteers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.volunteer-attendance.index') }}">My attendance</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu4" aria-expanded="false" aria-controls="menu4">
        <i class="menu-icon mdi mdi-trophy-outline"></i>
        <span class="menu-title">Achievement </span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu4">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/buttons.html">VOM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/typography.html">Other Achievement</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Basic UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu5" aria-expanded="false" aria-controls="menu5">
        <i class="menu-icon mdi mdi-image-filter"></i>
        <span class="menu-title">Media </span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu5">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/buttons.html">Menu 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/typography.html">Menu 2</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu6" aria-expanded="false" aria-controls="menu6">
        <i class="menu-icon mdi mdi-cube-outline"></i>
        <span class="menu-title">Library </span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu6">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/buttons.html">Menu 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/typography.html">Menu 2</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu101" aria-expanded="false" aria-controls="menu101">
        <i class="menu-icon mdi mdi-account-convert"></i>
        <span class="menu-title">Koordinator Menu</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu101">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.branch.index") }}"> Branch </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.subbranch.index") }}"> Subbranch </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#menu102" aria-expanded="false" aria-controls="menu102">
        <i class="menu-icon mdi mdi-incognito"></i>
        <span class="menu-title">Webdev Menu</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menu102">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.menu-builder.index') }}"> Generate Menu </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/error-404.html"> City </a>
          </li>
        </ul>
      </div>
    </li>
</ul>
</nav>