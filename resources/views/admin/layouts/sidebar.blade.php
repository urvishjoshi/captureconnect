 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="{{ route('a.dashboard.index') }}" class="brand-link">
	  <img src="{{ asset('favicon.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
	  <span class="brand-text font-weight-light"> <b>Capture Connect</b></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
	  <!-- Sidebar user panel (optional) -->
	  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			@if(auth()->user()->profile)
			  <img src="{{ asset('storage/profileimages/admin/'.$admin01[0]['profile']) }}" class="img-circle elevation-2" alt="{{$admin01[0]['profile']}}" style="width: 35px;height: 35px;">
			@else
			  <img class="img-circle elevation-2" style="width: 35px;height: 35px;">
			@endif
		</div>
		<div class="info">
		  <a href="{{ route('a.personal.index') }}" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
		</div>
	  </div>

	  <!-- Sidebar Menu -->
	  <nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

			<li class="nav-item">
			  <a href="{{ route('a.requests.index') }}" class="nav-link {{ (request()->is('admin/requests*')) ? 'active' : '' }}">
				<i class="fas fa-user-edit pl-2"></i>&nbsp;
				<p>Requests</p>
				<span class="badge badge-info right font-14 py-1">{{ count($allRequests) }}</span>
			  </a>
			</li>  

			<li class="nav-item">
			  <a href="{{ route('a.locations.index') }}" class="nav-link {{ (request()->is('admin/locations*')) ? 'active' : '' }}">
				<i class="fas fa-map-marker-alt pl-2"></i>&nbsp;&nbsp;&nbsp;
				<p>Locations</p>
			  </a>
			</li>  

			<li class="nav-item"> <!-- Kishan changed removed menu-open class -->
			  <a href="{{ route('a.capturers.index') }}" class="nav-link {{ (request()->is('admin/capturers*')) ? 'active' : '' }}">
				<i class="nav-icon  fas fa-user-tie"></i>
				<p>Capturers</p>
			  </a>
			</li>
			<li class="nav-item">
			  <a href="{{ route('a.toiletusers.index') }}" class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}">
				<i class="nav-icon fas fa-users"></i>
				<p>Users</p>
			  </a>
			</li>
			<li class="nav-item">
			  <a href="{{ route('a.toilets.index') }}" class="nav-link {{ (request()->is('admin/toilets*')) ? 'active' : '' }}">
				<i class="fas fa-restroom pl-1 pr-1"></i>
				  <p>Portfolio</p>
			  </a>
			</li> 
			<li class="nav-item">
			  <a href="{{ route('a.sales.index') }}" class="nav-link {{ (request()->is('admin/sales*')) ? 'active' : '' }}">
				<span style="font-size: 18px">Rs.</span>
				  <p>Sales</p>
			  </a>
			</li> 
			<li class="nav-item">
			  <a href="{{ route('a.ratings.index') }}" class="nav-link {{ (request()->is('admin/ratings*')) ? 'active' : '' }}">
				<i class="fa fa-star nav-icon"></i>
				<p>Ratings</p>
			  </a>
			</li>
			
			<li class="nav-item">
			  <a href="{{ route('a.reports.index') }}" class="nav-link {{ (request()->is('admin/reports*')) ? 'active' : '' }}">
				<i class="nav-icon fas fa-chart-pie"></i>
				<p>
				 Reports
				</p>
			  </a>
			</li>     
			<li class="nav-item">
			  <a href="{{ route('a.feedbacks.index') }}" class="nav-link {{ (request()->is('admin/feedbacks*')) ? 'active' : '' }}">
				<i class="fas fa-envelope" style="padding-left: 5px;"></i>
				<p class="pl-2">Feedbacks</p>
			  </a>
			</li><hr>  
		
		</ul>
	  </nav>
	  <!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
  </aside>
