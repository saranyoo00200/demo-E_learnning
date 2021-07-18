

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
            @role('teacher')
            <li class="nav-item dropdown">
              <li>
                  <a class="nav-link" href="{{ url('/users') }}"><i
                          class="far fa-user"></i><span>จัดการผู้ใช้งาน</span></a>
              </li>
            <li><a class="nav-link" href="{{ route('subject_learning') }}"><i class="fas fa-book"></i><span>จัดการวิชาเรียน</span></a>
            </li>
            <li><a class="nav-link" href="{{ url('/course_list')}}"><i class="fas fa-columns"></i><span>รายการวิชาเรียน</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/newsManage') }}"><i
                        class="fas fa-newspaper"></i><span>จัดการข่าวและกิจกรรม</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/chat_system') }}"><i class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/schedule_time') }}">
                  <i class="fas fa-calendar-alt"></i><span>จัดการตารางเรียน</span></a>
            </li>
            @endrole
            @role('admin')
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>รายการวิชา</span></a>
                <ul class="dropdown-menu"></ul>
            </li> --}}
            <li><a class="nav-link" href="{{ route('subject_learning') }}"><i class="fas fa-book"></i><span>จัดการวิชาเรียน</span></a>
            </li>
            <li><a class="nav-link" href="{{ url('/course_list')}}"><i class="fas fa-columns"></i><span>รายการวิชาเรียน</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/users') }}"><i
                        class="far fa-user"></i><span>จัดการผู้ใช้งาน</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/newsManage') }}"><i
                        class="fas fa-newspaper"></i><span>จัดการข่าวและกิจกรรม</span></a>
            </li>
            <li>
              <a class="nav-link" href="{{ url('/subject_calendar') }}"><i class="fas fa-newspaper"></i><span>จัดการเรียนการสอน</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/chat_system') }}"><i
                        class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
            </li>
            @endrole
            @role('user')
            <li>
                <a class="nav-link" href="{{ url('/chat_system') }}"><i
                        class="far far fa-comment"></i><span>ห้องสนทนา</span></a>
            </li>
            @endrole
    </aside>
</div>
