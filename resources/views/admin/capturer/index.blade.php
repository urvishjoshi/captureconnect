@section('title','Capturers')
@extends('admin.layouts.app')
@section('content')
<section>

	<div class="container pt-4 px-3">
		<div class="container col-md-auto">
			<div class="row">
				<div class="col-3"></div>
				<div class="col-md text-center">
					<h2 class="m-0">Active Capturers</h2>
				</div>
				<div class="col-md-3 text-right">
					<a href="{{route('a.capturers.create')}}" class="btn btn-primary">Add Capturers</a>
				</div>
			</div>
			<hr width=35%>
		{{-- <div class="panel panel-default">
			<div class="panel-heading">Search the Data</div>
			<div class="panel-body">
				<input type="text" name="search" id="search" class="form-control" placeholder="Enter name">
			</div>
		</div> --}}
		<div class="card">
			<div class="card-header border-0 p-0">
				<div class="container justify-content-center p-0" id="requestTable">
					<table class="table align-items-center table-hover table-flush text-center mb-0">
						<thead>
							<tr class="thead-light">
								<th>Id</th>
								<th>Email</th>
								<th>Name</th>
								<th>Studio</th>
								<th>Category</th>
								<th>Ratings</th>
								<th>Registered on</th>
								<th width="1%">Action</th>
							</tr>
						</thead>
						<tbody>
							@if( count($capturers) == 0 )
								<tr><td colspan="6"><center><h2>No Record found</h2></center></td></tr>
							@else
								@foreach($capturers as $capturer)
								<tr>
									<th scope="row">{{ $capturer->id }}</th>
									<td>{{ $capturer->email }}</td>
									<td>{{ $capturer->name }}</td>
									<td>{{ count($capturer->studio) }}</td>
									<td>
										@if($capturer->category==1)	Photographer
										@elseif($capturer->category==2)	Videographer
										@else Both @endif
									</td>
									<td>{{ $capturer->rating }}</td>
									<td>{{ $capturer->created_at->format('d/m/Y').' at '.$capturer->created_at->format('g:i A') }}</td>
									<td class="d-flex">
										<a href="{{ route('a.capturers.show',['id'=>$capturer->id,'name'=>$capturer->name]) }}" class="fas fa-id-badge text-success mx-auto my-auto" name="view"></a>
										<a href="{{ route('a.capturers.show',['id'=>$capturer->id,'name'=>$capturer->name]) }}" class="fas fa-edit ml-2 my-auto" name="edit"></a>
										<form action="{{ route('a.capturers.destroy',$capturer->id) }}" method="POST">
											@csrf @method('DELETE')
											<button class="btn" type="submit" name="delete"><i class="fas fa-trash-alt text-danger"></i></button>
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

</section>

@endsection