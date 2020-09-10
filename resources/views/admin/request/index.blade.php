@section('title','Requests')
@extends('admin.layouts.app')
@section('link')
<style>
	form .fas{font-size: 24px}
</style>
@endsection
@section('content')	
<?php $active=route('a.requests.show',1); 
$denied=route('a.requests.show',-1); ?>
<section>

	<div class="container pt-4">
		<div class="container col-md-auto">
			<div class="row">
				<div class="col-md-auto d-flex align-items-end flex-column ml-3" title="Active capturers">
					<a class="badge badge-pill badge-success font-14 style" href="{{ $active }}">
						{{ count($data->allActives) }}
					</a>
					<a href="{{ $active }}" class="fas fa-user-check" style="font-size: 34px;color: black;text-decoration:none; "></a>
				</div>
				<div class="col-md text-center">
					<h2>All Capturers pending requests</h2>
				</div>
				<div class="col-md-auto d-flex align-items-end flex-column mr-3" title="Denied capturers">
					<a class="badge badge-pill badge-warning font-14 style" href="{{ $denied }}">
						{{ count($data->allDeactives) }}
					</a>
					<a href="{{ $denied }}" class="fas fa-user-times" style="font-size: 36px;color: black;text-decoration:none; "></a>
				</div>
			</div>

			<HR width=50%>
			<div class="container justify-content-center pt-3" id="requestTable">
				<div class="card">
					<div class="card-header border-0 p-0">
						<div class="container justify-content-center p-0" id="requestTable">
							<table class="table align-items-center table-hover table-flush text-center mb-0">
								<thead>
									<tr class="thead-light">
										<th scope="col"width="1%">Id</th>
										<th scope="col">Name</th>
										<th scope="col">Email</th>
										<th scope="col">Contact</th>
										<th scope="col">Category</th>
										<th scope="col">Registered on</th>
										<th scope="col">Actions</th>
									</tr>
								</thead>
								<tbody>
									@if( count($data->allRequests) == 0 )
										<tr><td colspan="7"><center><h2>No Requests</h2></center></td></tr>
									@else
										@foreach($data->allRequests as $owner)
										<tr>
											<th scope="row">{{ $owner->id }}</th>
											<td>{{ $owner->name }}</td>
											<td>{{ $owner->email }}</td>
											<td>{{ $owner->mobileno }}</td>
											<td>
												@if($owner->category==1)
												photographer
												@elseif($owner->category==2)
												videographer
												@else
												both
												@endif
											</td>
											<td>{{ $owner->created_at->format('d/m/Y').' at '.$owner->created_at->format('g:i A') }}</td>
											<td>
												<form action="{{ route('a.requests.update',$owner->id) }}" method="POST">
													@method('PUT') @csrf

													<button class="btn" name="btn" type="submit" value="1"><i class="fas fa-check text-success"></i></button> &nbsp;&nbsp;
													<a href="{{ route('a.toiletowners.show',['id'=>$owner->id,'name'=>$owner->name]) }}" class="fas fa-id-badge" name="view"></a>&nbsp;&nbsp;
													<button class="btn" name="btn" type="submit" value="-1"><i class="fas fa-times text-warning"></i></button>
												</form>
											</td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
@endsection