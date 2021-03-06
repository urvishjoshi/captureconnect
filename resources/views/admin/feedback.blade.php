@section('title','Feedbacks')
@extends('admin.layouts.app')
@section('content')

<section>
	<!-- Content Header (Page header) -->
	<div class="content pt-4">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md text-center">
					<h2>Feedbacks</h2>
				</div><!-- /.col -->
			</div><!-- /.row -->
			<HR width=30%>

		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="container justify-content-center" id="requestTable">
				<div class="card">
					<div class="card-header border-0 p-0">
						<div class="container justify-content-center p-0" id="requestTable">
							<table class="table align-items-center table-hover table-flush text-center mb-0">
								<thead>
									<tr class="thead-light">
										<th scope="col">Id</th>
										<th scope="col">Feedbacker id</th>
										<th scope="col">Feedbacker</th>
										<th scope="col">Subject</th>
										<th scope="col">Description</th>
										<th scope="col">Received on</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@if( count($feedbacks) == 0 )
									<tr><td colspan="7"><center><h2>No feedbacks</h2></center></td></tr>
									@else
									@foreach($feedbacks as $feedback)
									<tr>
										<th scope="row">{{ $feedback->id }}</th>
										<td>{{ $feedback->feedbacker_id }}</td>
										<td>{{ $feedback->feedbacker_type=='1' ? 'Owner' : 'User' }}</td>
										<td>{{ $feedback->subject }}</td>
										<td>{{ $feedback->desc }}</td>
										<td>{{ $feedback->created_at->format('d/m/Y').' at '.$feedback->created_at->format('g:i A') }}</td>
										<td>
											<form action="{{ route('a.feedbacks.destroy',$feedback->id) }}" method="POST">
												@csrf @method('DELETE')
												<button class="btn btn-sm btn-danger" name="btn" type="submit" value="delete">Delete</button>
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