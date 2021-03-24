@section('title','Studio')
@extends('capturer.layouts.app')
@section('content')
<?php $key=\App\Model\Admin::first('mapkey'); ?>

@if($thisOwner[0]['status']=='0')
	<script>
		$(function() {  //disables all inputs
			$("div *").attr("disabled", "disabled").off('click');
			$("div *").attr("title", "Your account is not active yet, you can't create new studios");
		})
	</script>
	<div class="container-fluid row justify-content-center pt-4">
		<div class="alert bg-warning text-center font-20">
			You can't create new studios, Please <a href="{{ route('feedbacks.index') }}" >contact</a> admin for more details.
		</div>
	</div>

<section>
	<div class="content-header pb-0 pt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0" class="tooltip-test">Your Studios</h3>
						</div>
						<div class="col-4 text-right">
						  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewStudio">
							  Add new Studio
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
@else
<section>
	<div class="content-header pb-0 pt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0" class="tooltip-test">Your Studios</h3>
						</div>
						<div class="col-4 text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewStudio">
								Add new Studio
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="content-header pt-0">
		<div class="container-fluid">
			<div class="container justify-content-center pt-3" id="requestTable">
				<div class="card">
					<div class="card-header border-0 p-0">
						<div class="container justify-content-center p-0" id="requestTable">
							<table class="table align-items-center table-hover table-flush text-center mb-0">
								<thead>
									<tr class="thead-light">
										<th center>Id</th>
										<th>Studio name</th>
										<th>Complex</th>
										<th>Address</th>
										<th>Type type</th>
										<th>Status</th>
										<th>Price</th>
										<th>Created on</th>
										<th width="5%">Action</th>
									</tr>
								</thead>
								<tbody>
									@if( count($studios) == 0 )
									<tr><td colspan="9"><center><h2>No Studio created</h2></center></td></tr>
									@else
									@foreach($studios as $studio)
									<tr>
										<th scope="row">{{ $studio->id }}</th>
										<td>{{ $studio->studio_name }}</td>
										<td>{{ $studio->complex_name }}</td>
										<td>{{ $studio->address }}</td>
										<td>
											@if($studio->type==1) Male @elseif($studio->type==0) Female @else Male & Female @endif
										</td>
										<td>
											@if($studio->status==1) <f class="text-success">Active</f> @else <f class="text-danger">Not Active</f> @endif
										</td>
										<td><b>${{ $studio->price }}</b></td>
										<td>{{ $studio->created_at->format('d/m/Y').' at '.$studio->created_at->format('g:i A') }}</td>
										<td>
											<form action="{{ route('studios.destroy',$studio->id) }}" method="POST" class="d-flex mb-0">
												@method('DELETE') @csrf
												<a href="{{ route('studios.show',$studio->id) }}" class="btn btn-success" name="btn">Edit</a>&nbsp;&nbsp;
												<button type="submit" class="btn btn-danger" name="btn">Delete</button>
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

	<!-- Modal -->
	<div class="modal fade bd-example-modal-xl mt-3" id="addNewStudio" tabindex="-1" role="dialog" aria-labelledby="addNewStudioLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title">Create new Studio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('studios.store') }}" method="post" class="mb-0">
					@method('POST') @csrf
					<div class="modal-body row">
						<div class="col-6">
							<h6 class="heading-small text-muted mb-2">Studio information</h6>

							<div class="lg-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="studioname">Studio name</label>
											<input type="text" id="studioname" name="studioname" class="form-control" placeholder="Studio name" value="{{old('studioname')}}" required>
											@error('studioname')
											<span class="text-danger font-14" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label" for="studiostatus">Studio status</label>
											<select class="custom-select" id="studiostatus" name="studiostatus">
												<option disabled>Status</option>
												<option value="1" class="text-success">Active</option>
												<option value="0" class="text-danger">Not active</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="lg-4">
								<div class="row">
									<div class="form-group col-md-2 px-1">
										<label class="form-control-label" for="studioprice">Price in <b>KD</b></label>
										<input id="studioprice" name="studioprice" class="form-control px-1" placeholder="KD" value="{{old('studioprice')}}" type="number" min="0" step="0.001" required>
										@error('studioprice')
										<span class="text-danger font-14" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="form-control-label" for="studiotype">Studio type</label>
											<select class="custom-select" id="studiotype" name="studiotype">
												<option disabled>studio for</option>
												<option value="2" selected>Male & Female</option>
												<option value="1">Male only</option>
												<option value="0">Female only</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-control-label" for="complexname">Complex name</label>
											<input id="complexname" name="complexname" class="form-control" placeholder="Studio Complex" value="{{old('complexname')}}" type="text" required>
											@error('complexname')
											<span class="text-danger font-14" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-12">
										<label class="form-control-label" for="address">Street Address</label>
										<input type="text" id="address" name="address" class="form-control" placeholder="Street address of your studio" value="{{old('address')}}" required>
										@error('address')
										<span class="text-danger font-14" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								{{-- <div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="country">Country</label>
											<select name="country" class="form-control" id="country" required>
												<option value="">select</option>
												@foreach ($countries as $country)
												<option value="{{ $country->id }}">{{ $country->country }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="state">Governance</label>
											<select name="state" class="form-control" id="state" required>
												<option value="">-select-</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="city">City</label>
											<select name="city" class="form-control" id="city" required>
												<option value="">-select-</option>
											</select>
										</div>
									</div>
									<span class="text-secondary font-14 pl-2 align-self-end">*All fields are mandatory to fill</span>
								</div> --}}
							</div>
						</div> {{-- modal-body-row --}}
						<div class="col-6" >
							<div class="alert bg-primary text-dark alert-dismissible fade show" role="alert" style="position: fixed;z-index: 99;max-width: 50%;float: right;opacity: 0.6">
								Click anywhere on the map to put a marker for your studio
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div id="map" style="width:100%;height:400px;"></div>

							<input type="hidden" name="newLat" id="newLat" value="{{old('newLat')}}">
							<input type="hidden" name="newLng" id="newLng" value="{{old('newLng')}}">

							<script src="https://maps.googleapis.com/maps/api/js?key={{$key->mapkey}}&callback=myMap"></script>

						</div>
					</div>
					<div class="modal-footer bg-light">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" id="btn-addstudio" name="btn-addstudio" class="btn btn-primary">Add Studio</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>

$(document).ready(function(){
	@if($errors->any())
		$('#addNewStudio').modal('show');
	@endif

	$("#country").on('change',function(){
		$.ajax({
			method:"GET",
			url:"{{ route('studios.show',1) }}",
			data: {
			   'country_id': $(this).val(),
				'_token': $('input[name=_token]').val(),
				'_method': '{{method_field('GET')}}',
			},
			dataType:'html',
			success:function(data){
				if(data<1)
					$("#state").html('<option value="">-No Governance found-</option>');
				else
					$("#state").html(data);
				$("#city").html('<option value="">-select-</option>');
			}
		});
	});

	$("#state").on('change',function(){
		$.ajax({
			method:"GET",
			url:"{{ route('studios.show',1) }}",
			data: {
			   'state_id': $(this).val(),
				'_token': $('input[name=_token]').val(),
				'_method': '{{method_field('GET')}}',
			},
			dataType:'html',
			success:function(data){
				if(data<1)
					$("#city").html('<option value="">-No city found-</option>');
				else
					$("#city").html(data);
			}
		});
	});
});
</script>
@endif
@endsection
<script>
		var marker;
	var infowindow;

	function myMap() {
		var mapProp= {
			center:new google.maps.LatLng(29.3117,47.4818),
			zoom:8,
			gestureHandling: 'greedy'
		};
		var map = new google.maps.Map(document.getElementById("map"),mapProp);
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(map, event.latLng);
			document.getElementById("newLat").value = event.latLng.lat();
			document.getElementById("newLng").value = event.latLng.lng();
		});
	}

	function placeMarker(map, location) {
		if (!marker || !marker.setPosition) {
			marker = new google.maps.Marker({
				position: location,
				map: map,
				animation: google.maps.Animation.DROP
			});
		} else {
			marker.setPosition(location);
		}
		if (!!infowindow && !!infowindow.close) {
			infowindow.close();
		}
		infowindow = new google.maps.InfoWindow();
		infowindow.setContent('Set this location as a studio spot')
		infowindow.open(map,marker);
	}
</script>