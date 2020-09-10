@section('title','Capturers')
@extends('admin.layouts.app')
@section('content')
<section>

	<div class="container pt-4">
		<div class="container col-md-auto">
			<div class="row">
				<div class="col-md-1 d-flex align-items-start flex-column">
						<a href="{{ url()->previous() }}" class="fas fa-arrow-left pt-3 pl-2" style="font-size: 30px;text-decoration:none; "></a>
				</div>
				<div class="col-md text-center">
					<h2>Profile of <b>{{ $name }}</b></h2>
				</div>
				<div class="col-md-1"></div>
			</div>
			<hr width=50%>
			{{-- <div class="panel panel-default">
				<div class="panel-heading">Search the Data</div>
				<div class="panel-body">
					<input type="text" name="search" id="search" class="form-control" placeholder="Enter name">
				</div>
			</div> --}}

			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-auto">
							<h3 class="mb-0">Personal Details of <b>{{ $name }}</b></h3>
						</div>
						<div class="col d-flex justify-content-end" title="Toiletowner id is a fixed attribute, thus can't be changed">
							<h4 class="mb-0">Owner ID-<b>{{ $info[0]['id'] }}</b></h4>
						</div>
					</div>				
				</div>
				<div class="card-body">
					<h6 class="heading-small text-muted pl-3 mb-3">Profile Picture<span class="mx-3"></span> User information</h6>
					<div class="">
						<div class="row">
							<div class="px-4">
								<form method="POST" action="{{ route('a.toiletowners.update',1) }}" enctype="multipart/form-data" id="imgform"> @csrf @method('PUT')
									<div id="profileDiv" style="height: 100px;width: 100px;border: 1px dashed lightgrey;">

										<img src="{{ asset('storage/profileimages/'.$info[0]['profile']) }}" alt="No image" class="profileimg" width="100" height="100">
										<div class="hoverabletext">
											<a href="#" class="imgtext fas fa-camera"></a>
										</div><br>
									</div>
									<div class="d-flex justify-content-center mt-2">
										<button class="text-primary btn btn-sm pointer" id="uploadImg">Upload</button>
									</div>
									<div id="uploadText" class="font-14 text-center text-success"></div>
									@error('profile')
									<span class="text-danger font-14" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<input type="file" name="profile" id="file" hidden>
									<input type="hidden" name="ownerId" value="{{ $info[0]['id'] }}" hidden>
								</form>
							</div>
							<div class="col-lg">
								<form action="{{ route('a.toiletowners.update',$info[0]['id']) }}" method="post"> @method('PUT') @csrf
									<div class="form-group">
										<label class="form-control-label" for="name">Name</label>
										<input type="text" id="ownername" name="ownername" class="form-control @error('ownername') is-invalid @enderror" placeholder="Name" value="{{$info[0]['name']}}">
										@error('ownername')
										    <span class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </span>
										@enderror
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<label class="form-control-label" for="email">Email address</label>
										<input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{$info[0]['email']}}">
										@error('email')
										    <span class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </span>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg mt-2 ml-3">
								<div class="form-group">
									<label class="form-control-label" for="password">New Password</label>
									<input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New password" value="">
									@error('password')
									    <span class="invalid-feedback" role="alert">
									        <strong>{{ $message }}</strong>
									    </span>
									@enderror
								</div>
							</div>
							<div class="col-lg mt-2 ml-3">
								<div class="form-group">
									<label class="form-control-label" for="password_confirmation">Password confirmation</label>
									<input type="text" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-type password" value="">
								</div>
							</div>
						</div>
						<hr class="my-2" />
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">Contact information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="form-control-label" for="contactno">Contact no</label>
										<input type="text" id="contactno" name="contactno" class="form-control @error('contactno') is-invalid @enderror" placeholder="Contact" value="{{$info[0]['mobileno']}}">
										@error('contactno')
										    <span class="invalid-feedback" role="alert">
										        <strong>{{ $message }}</strong>
										    </span>
										@enderror
									</div>
								</div>
							</div>
							{{-- <div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="city">City</label>
										<input type="text" id="city" name="city" class="form-control" placeholder="City"  value=""><!-- Owner city -->
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="country">Country</label>
										<input type="text" id="country" name="country" class="form-control" placeholder="Country" value=""><!-- Owner countary -->
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="postal-code">Postal code</label>
										<input type="number" id="postalcode" name="postalcode" class="form-control" placeholder="6 digit code"><!-- Owner Postal code -->
									</div>
								</div>
							</div> --}}
							<button type="submit" id="submitbtn" name="submitbtn" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@method('POST') @csrf
</section>
@section('jquery')
<script>
	$(document).ready(function()
	{
		$(function() {
    		$('.imgtext').click(function(event) {
    			$('#file').trigger('click');
    		});

	    	$('#file').change(function() {
	    		var file = $('#file')[0].files[0].name;
	    		$('#uploadText').text(file);
	    		$('#uploadImg').removeClass('text-primary').addClass('btn-primary');
	    	});
    	});

		$('#autoalloc').change(function() {
        if($('#autoalloc').val()=='0')
        	$("#requestlink").hide();
        else
            $("#requestlink").show();
        $.ajax({
            url: '{{ route('a.toiletowners.store') }}',
            data: {
            		'id': {{$info[0]['id']}},
                   'autoalloc': $('#autoalloc').val(),
                    '_token': $('input[name=_token]').val(),
                    '_method': $('input[name=_method]').val(),
                  },
            type: 'POST',
            dataType: 'json',
            success: function (response) {

                $('#autoalloc').attr('value', response.status);

            }
        });
    });
	});
</script>
@endsection
@endsection