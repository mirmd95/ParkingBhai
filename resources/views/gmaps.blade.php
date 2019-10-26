@extends('layouts.ownerApp')
@section('title','Owner Get Location')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header"><h2><p style="text-align: center;">{{ __('Get Location') }}</p></h2></div>
                <div class="table-responsive">
					<p>Get Your Location And Save</p> 
					<button class= "geeks" type="button" id="save"> 
						Save</button> 
					<div id="demo2" style="width: 1100px; height: 500px;"> 	
					</div>
                    
                </div>
                    
            </div>
          </div>
       </div>
</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script> 
		<script type="text/javascript"> 

		function getlocation(){ 
			if(navigator.geolocation){ 
				navigator.geolocation.getCurrentPosition(showLoc, errHand); 
			} 
		} 
		function showLoc(pos){ 
			latt = pos.coords.latitude; 
			long = pos.coords.longitude; 
			window.lat = latt;
			window.long = long;

			var lattlong = new google.maps.LatLng(latt, long); 
			var OPTions = { 
				center: lattlong, 
				zoom: 16, 
				mapTypeControl: true, 
				navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL} 
			} 
			var mapg = new google.maps.Map(document.getElementById("demo2"), OPTions); 
			var markerg = 
			new google.maps.Marker({position:lattlong, map:mapg, title:"You are here!"});
			
		} 
		
		function errHand(err) { 
			switch(err.code) { 
				case err.PERMISSION_DENIED: 
					result.innerHTML = "The application doesn't have the permission" + 
							"to make use of location services" 
					break; 
				case err.POSITION_UNAVAILABLE: 
					result.innerHTML = "The location of the device is uncertain" 
					break; 
				case err.TIMEOUT: 
					result.innerHTML = "The request to get user location timed out" 
					break; 
				case err.UNKNOWN_ERROR: 
					result.innerHTML = "Time to fetch location information exceeded"+ 
					"the maximum timeout interval" 
					break; 
			} 
		} 
		$(document).ready(function(){
			getlocation();
			$('#save').click(function() {
				$.post("{{ route('location.save') }}", {
					_token: '{{ csrf_token() }}',
					lat: window.lat,
					long: window.long
				});
			});
		});
		</script> 
@endsection

{{-- 

<!DOCTYPE html> 
<html> 
	<head> 
		<title>Display location in map</title> 
		<style> 
			.gfg { 
				font-size:40px; 
				font-weight:bold; 
				color:#009900; 
				margin-left:20px; 
			} 
			.geeks { 
				margin-left:150px; 
			} 
			p { 
				font-size:20px; 
				margin-left:20px; 
			} 
		</style> 
	</head> 
	<body> 
		<div class = "gfg">GeeksforGeeks</div> 
		<p>Display location in map</p> 
		<php echo $id ?>
		<button class= "geeks" type="button" id="save"> 
			Save</button> 
		<div id="demo2" style="width: 500px; height: 500px;"> 
			
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script> 
		<script type="text/javascript"> 

		function getlocation(){ 
			if(navigator.geolocation){ 
				navigator.geolocation.getCurrentPosition(showLoc, errHand); 
			} 
		} 
		function showLoc(pos){ 
			latt = pos.coords.latitude; 
			long = pos.coords.longitude; 
			window.lat = latt;
			window.long = long;

			var lattlong = new google.maps.LatLng(latt, long); 
			var OPTions = { 
				center: lattlong, 
				zoom: 16, 
				mapTypeControl: true, 
				navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL} 
			} 
			var mapg = new google.maps.Map(document.getElementById("demo2"), OPTions); 
			var markerg = 
			new google.maps.Marker({position:lattlong, map:mapg, title:"You are here!"});
			
		} 
		
		function errHand(err) { 
			switch(err.code) { 
				case err.PERMISSION_DENIED: 
					result.innerHTML = "The application doesn't have the permission" + 
							"to make use of location services" 
					break; 
				case err.POSITION_UNAVAILABLE: 
					result.innerHTML = "The location of the device is uncertain" 
					break; 
				case err.TIMEOUT: 
					result.innerHTML = "The request to get user location timed out" 
					break; 
				case err.UNKNOWN_ERROR: 
					result.innerHTML = "Time to fetch location information exceeded"+ 
					"the maximum timeout interval" 
					break; 
			} 
		} 
		$(document).ready(function(){
			getlocation();
			$('#save').click(function() {
				$.post("{{ route('location.save') }}", {
					_token: '{{ csrf_token() }}',
					lat: window.lat,
					long: window.long
				});
			});
		});
		</script> 
	</body> 
</html>						 
 --}}