        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- ./Left navbar links -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/public/dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/public/dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/public/dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="javascript:;" class="brand-link" style="text-align: center">
                <span class="brand-text font-weight-light"
                    style="font-weight: bold !important ; font-size: 20px;">School</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">


                        {{-- ??  Admin - Teacher - Studnet - Parent ?? --}}
                        @if (Auth::user()->user_type == 1)
                            <li class="nav-item">
                                <a href="/admin/dashboard"
                                    class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/account"
                                    class="nav-link @if (Request::segment(2) == 'account') active @endif">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p>
                                        My Account
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/admin/list"
                                    class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Admin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/teacher/list"
                                    class="nav-link @if (Request::segment(2) == 'teacher') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Teacher
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/student/list"
                                    class="nav-link @if (Request::segment(2) == 'student') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Student
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/parent/list"
                                    class="nav-link @if (Request::segment(2) == 'parent') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Parent
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item @if (Request::segment(2) == 'class' ||
                                    Request::segment(2) == 'subject' ||
                                    Request::segment(2) == 'assign_subject' ||
                                    Request::segment(2) == 'assign_class_teacher' ||
                                    Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif ">
                                <a href="#" class="nav-link @if (Request::segment(2) == 'class' ||
                                        Request::segment(2) == 'subject' ||
                                        Request::segment(2) == 'assign_subject' ||
                                        Request::segment(2) == 'assign_class_teacher' ||
                                        Request::segment(2) == 'class_timetable') ) active @endif ">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Academics
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">


                                    <li class="nav-item">
                                        <a href="/admin/class/list"
                                            class="nav-link @if (Request::segment(2) == 'class') active @endif">
                                            <i class="nav-icon far fa-user"></i>

                                            <p>
                                                Class
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/subject/list"
                                            class="nav-link @if (Request::segment(2) == 'subject') active @endif">
                                            <i class="nav-icon far fa-user"></i>
                                            <p>
                                                Subject
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/assign_subject/list"
                                            class="nav-link @if (Request::segment(2) == 'assign_subject') active @endif">
                                            <i class="nav-icon far fa-user"></i>
                                            <p>
                                                Assign Subject
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/class_timetable/list"
                                            class="nav-link @if (Request::segment(2) == 'class_timetable') active @endif">
                                            <i class="nav-icon far fa-user"></i>
                                            <p>
                                                Class Timetable
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/admin/assign_class_teacher/list"
                                            class="nav-link @if (Request::segment(2) == 'assign_class_teacher') active @endif">
                                            <i class="nav-icon far fa-user"></i>
                                            <p>
                                                Assign Teacher's Class
                                            </p>
                                        </a>
                                    </li>


                                </ul>
                            </li>



                            <li class="nav-item">
                                <a href="/admin/change_password"
                                    class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                                    <i class="nav-icon fas fa-keyboard"></i>
                                    <p>
                                        Change Password
                                    </p>
                                </a>
                            </li>

                            {{-- ?? Teacher ?? --}}
                        @elseif (Auth::user()->user_type == 2)
                            <li class="nav-item">
                                <a href="/teacher/dashboard"
                                    class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/teacher/account"
                                    class="nav-link @if (Request::segment(2) == 'account') active @endif">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p>
                                        My Account
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/teacher/change_password"
                                    class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                                    <i class="nav-icon fas fa-keyboard"></i>
                                    <p>
                                        Change Password
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/teacher/my_class_subject"
                                    class="nav-link @if (Request::segment(2) == 'my_class_subject') active @endif">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>
                                        My Classes & Subjects
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/teacher/my_student"
                                    class="nav-link @if (Request::segment(2) == 'my_student') active @endif">
                                    <i class="nav-icon far fa-user-circle"></i>
                                    <p>
                                        My Students
                                    </p>
                                </a>
                            </li>

                            {{-- ?? Student ?? --}}
                        @elseif (Auth::user()->user_type == 3)
                            <li class="nav-item">
                                <a href="/student/dashboard"
                                    class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/student/my_subject"
                                    class="nav-link @if (Request::segment(2) == 'my_subject') active @endif">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        My Subjects
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/student/my_timetable"
                                    class="nav-link @if (Request::segment(2) == 'my_timetable') active @endif">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        My Timetable
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/student/account"
                                    class="nav-link @if (Request::segment(2) == 'account') active @endif">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p>
                                        My Account
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/student/change_password"
                                    class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                                    <i class="nav-icon fas fa-keyboard"></i>
                                    <p>
                                        Change Password
                                    </p>
                                </a>
                            </li>
                            {{-- ?? Parent ?? --}}
                        @elseif (Auth::user()->user_type == 4)
                            <li class="nav-item">
                                <a href="/parent/dashboard"
                                    class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/parent/my_student"
                                    class="nav-link @if (Request::segment(2) == 'my_student') active @endif">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        My Student
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/parent/account"
                                    class="nav-link @if (Request::segment(2) == 'account') active @endif">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p>
                                        My Account
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/parent/change_password"
                                    class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                                    <i class="nav-icon fas fa-keyboard"></i>
                                    <p>
                                        Change Password
                                    </p>
                                </a>
                            </li>
                        @endif
                        {{-- ?? Common Links ?? --}}
                        <li class="nav-item">
                            <a href="/logout" class="nav-link ">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                        {{-- Common Links --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.Main Sidebar Container -->
