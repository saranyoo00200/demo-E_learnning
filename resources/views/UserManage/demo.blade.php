<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">E-LEARING</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="{{ url('/dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>รายการวิชา</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('subject_learning') }}"><i class="fas fa-book"></i>วิชาเรียน</a></li>
                    {{-- <li><a class="nav-link" href="{{ route('subject') }}"><i class="fas fa-book"></i>บทนำ</a></li>
                    <li><a class="nav-link" href="{{ route('postSubject') }}"><i class="fas fa-book"></i>บทเรียน</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('postSubject') }}"><i class="fas fa-book"></i>บททดสอบก่อนเรียน</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('preSubject') }}"><i class="fas fa-book"></i>บททดสอบหลังเรียน</a> --}}
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/users') }}"><i
                        class="far fa-user"></i><span>จัดการผู้ใช้งาน</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                    <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                    <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                    <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                    <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                    <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                    <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                    <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                    <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                    <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                    <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                    <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                    <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                    <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                    <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                    <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                    <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                    <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                    <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                    <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                </ul>
            </li>
    </aside>
</div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> dev-pan






<div class="sidebar-brand">
  <a href="{{ url('/') }}">E-LEARING</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
  <a href="index.html">St</a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item dropdown">
      <a href="{{ url('/dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">Starter</li>
    @role('teacher')
    <li class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>รายการวิชา</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ url('/introduction') }}"><i class="fas fa-book"></i>บทนำ</a></li>
      </ul>
    </li>
    <li>
      <a class="nav-link" href="{{ url('/news')}}"><i class="fas fa-newspaper"></i><span>จัดการข่าวและกิจกรรม</span></a>
    </li>
    <li>
      <a class="nav-link" href="{{ url('/chat_system')}}"><i class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
    </li>
    @endrole
    @role('admin')
            <li class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>รายการวิชา</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ url('/introduction') }}"><i class="fas fa-book"></i>บทนำ</a></li>
      </ul>
    </li>
    <li>
      <a class="nav-link" href="{{ url('/news')}}"><i class="fas fa-newspaper"></i><span>จัดการข่าวและกิจกรรม</span></a>
    </li>
    <li>
      <a class="nav-link" href="{{ url('/chat_system')}}"><i class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
    </li>
    <li>
      <a class="nav-link" href="{{ url('/users')}}"><i class="far fa-user"></i><span>จัดการผู้ใช้งาน</span></a>
    </li>
    @endrole
         @role('user')
    <li>
      <a class="nav-link" href="{{ url('/chat_system')}}"><i class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
    </li>
    @endrole
<<<<<<< HEAD
=======
>>>>>>> parent of 6df8a81 (Revert "Merge branch 'dev-pan' into maix")
=======
>>>>>>> dev-pan
