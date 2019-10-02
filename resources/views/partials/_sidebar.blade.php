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
</ul>
</nav>

