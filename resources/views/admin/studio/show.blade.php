@section('title','Studios')
@extends('admin.layouts.app')
@section('content')

<section>
	<!-- Content Header (Page header) -->
	<div class="content pt-4">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 d-flex align-items-start flex-column">
					<a href="{{ url()->previous() }}" class="fas fa-arrow-left pt-3 pl-2" style="font-size: 30px;text-decoration:none; "></a>
				</div>
				<div class="col-md text-center">
					<h2>Studio of <b>{{ $name }}</b></h2>
				</div>
				<div class="col-1"></div>
			</div><!-- /.row -->
			<HR width=20%>
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
										<th width="1%">Id</th>
										<th width="1%">Owner id</th>
										<th width="10%">Studio Banner</th>
										<th>Studio name</th>
										<th>Address</th>
										<th width="1%">Status</th>
										<th>Created on</th>
										<th width="1%">Map</th>
									</tr>
								</thead>
								<tbody>
									@if( count($studios) == 0 )
										<tr><td colspan="9"><center><h2>No Studios registered</h2></center></td></tr>
									@else
										@foreach($studios as $studio)
										<tr>
											<th scope="row">{{ $studio->id }}</th>
											<td title="{{ $studio->owner['email'] }}">
												{{ $studio->owner['id'] }}
											</td>
											<td title="{{$studio->banner}}">
												<img src="{{ asset('storage/studios/'.$studio->banner) }}" alt="No image" width="100%">
											</td>
											<td>{{ $studio->name }}</td>
											<td>{{ $studio->address }}</td>
											<td>
												<i class="fas fa-circle @if($studio->status==1) text-success" title="Active" @elseif($studio->status==0) text-warning" title="Not active" @else text-danger" title="Denied" @endif></i> 
											</td>
											<td>{{ $studio->created_at->format('d/m/Y').' at '.$studio->created_at->format('g:i A') }}</td>
											<td>
												<button class="btn" id="mapButton" data-toggle="modal"  data-target=".bd-example-modal-lg" onclick="myMap({{ $studio->lat }},{{ $studio->lng }})"><i class="fas fa-map-marked-alt text-info"></i></button>
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
<div class="modal fade bd-example-modal-lg mt-4 ml-5 ml-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content p-1">
			<div id="map" style="width:100%;height:500px;">
			</div>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGBvEqVEGH6-O3GAzwlH1aon9m0iVslTo&callback=myMap"></script>
	    </div>
	  </div>
	</div>
@endsection
<script>
    function myMap(currentLat,currentLng) {
    	var myLatLng = {
    	 	lat: currentLat, 
    	 	lng: currentLng
    	};
        var mapProp= {
			center: myLatLng,
			zoom:15,
			gestureHandling: 'greedy'
		};
		var map = new google.maps.Map(document.getElementById("map"),mapProp);

		placeMarker(map, myLatLng);  //place a stable marker in map
    }

    function placeMarker(map, location) {
    	var marker;
    	var infowindow;
        if (!marker || !marker.setPosition) {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.DROP
            });
        }
        marker.setPosition(location);
        if (infowindow && infowindow.close) {
            infowindow.close();
        }
        infowindow = new google.maps.InfoWindow({
            content: 'This location is setted as a toilet spot'
        });
        infowindow.open(map,marker);
    }
</script>