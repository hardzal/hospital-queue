<!-- Brand Logo -->
<a href="{{ route('dashboard.index') }}" class="brand-link">
    {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">RS Ananda</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->first()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @if(auth()->user()->role_id == 1)
            <li class="nav-item">
                <a href="{{ route('patients.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-hospital-user"></i>
                    <p>
                        Patient
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('polyclinics.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-clinic-medical"></i>
                    <p>
                        Polyclinic
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('records.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Medical Record
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('schedules.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        Schedules
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('doctorschedules.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Doctor Schedules
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('queues.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Queue</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('whatsapp.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        WA Messages
                    </p>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('queues.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Antrian</p>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>{{ __('Logout') }}</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
