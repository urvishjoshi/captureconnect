<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('capturers/dashboard') }}" class="brand-link"><!--Kishan changed Link-->
        <img src="{{ asset('favicon.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"> <b> Capture Connect</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->profile)
                    <img src="{{ asset('storage/profileimages/'.$thisOwner[0]['profile']) }}" class="img-circle elevation-2" alt="{{$thisOwner[0]['profile']}}" style="width: 35px;height: 35px;">
                @else
                    <img class="img-circle elevation-2" style="width: 35px;height: 35px;">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('personal.index') }}" class="d-block {{ (request()->is('capturers/personal*')) ? 'active' : '' }}">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item" id="requestlink" style="display: {{ $thisOwner[0]['auto_allocate']=='1' ? 'none' : 'block' }};">
                    <a href="{{ route('requests.index') }}" class="nav-link {{ (request()->is('capturers/requests*')) ? 'active' : '' }}"><!--Kishan changed link-->
                        <i class="fas fa-user-edit pl-2"></i>&nbsp;
                        <p>Requests</p><!--Kishan changed Menu-->
                        <span class="badge badge-info right font-14 py-1">{{ count($allRequests) }}</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('studios.index') }}" class="nav-link {{ (request()->is('capturers/studios*')) ? 'active' : '' }}"><!--Kishan changed link-->
                        <i class="fab fa-instagram pl-1 pr-1" style="font-size: 20px!important"></i>
                        <p class="pl-2">Your Studios</p><!--Kishan changed Menu-->
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ (request()->is('capturers/users*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Your Users</p>
                    </a>
                </li>
                <li class="nav-item"><!--Kishan changed link-->
                    <a href="{{ route('sales.index') }}" class="nav-link {{ (request()->is('capturers/sales*')) ? 'active' : '' }}">
                        <i class="fa fa-usd nav-icon" style="font-size: 20px"></i>
                        <p>Studio Sales</p>
                    </a>
                </li> 
                <li class="nav-item has-treeview">
                    <a href="{{ route('ratings.index') }}" class="nav-link {{ (request()->is('capturers/ratings*')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-star "></i>
                        <p>Studio Ratings</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ (request()->is('capturers/reports*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Studio Reports</p>
                    </a>
                </li>  

                <li class="nav-item"><!--Kishan changed link-->
                    <a href="{{ route('feedbacks.index') }}" class="nav-link {{ (request()->is('capturers/feedbacks*')) ? 'active' : '' }}">
                        <i class="fas fa-envelope" style="padding-left: 5px;"></i>
                        <p class="pl-2">Feedback</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
