@extends('layouts.driverApp')
@section('title','Driver Home')
@section('content')
	<div class="container">
	    <div class="row">
	    	

        	<div class="col-md-8">
         		<div id="mapdiv" style="height: 450px ;width: 750px"></div>
    		</div>
    		
	       <div class="col-md-4">
	    		<div class="card s" style="height: 450px">
	    			<div class="card title" style="text-align: center;">
	    				<h4><b style="color:#545557;">Searching Result</b></h4>
	    			</div>
	    			<div class="overflow-auto">
		    			<div class="card-body">
		    				
		    				@foreach($tasks as $task)
						    	<div class="card">
								   <h6><b style="color: #333300;">Name: </b>{{ $task->name }}</h6><br>
								   <h6><b style="color: #333300;">Area: </b>{{ $task->Area }}</h6><br>
								   <h6><b style="color: #333300;">Phone: </b>{{ $task->phone_number }}</h6><br>
								   <h6><b style="color: #333300;">Address: </b>{{ $task->address }}</h6><br>
								   
							   	</div>
							   	<br>

							@endforeach
		    				
					    </div>
					</div>
	    		</div>
	    	</div>
	    </div>
	</div>
	
	<?php
	 $a = $id1;
	 $b = $id2;
	 ?>

              
	<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
	          <script>
	            map = new OpenLayers.Map("mapdiv");
	            map.addLayer(new OpenLayers.Layer.OSM());
	            
	            var latt = <?php echo $a?>;
	            var long = <?php echo $b?>;
	            var lonLat = new OpenLayers.LonLat(long, latt  )
	                  .transform(
	                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
	                    map.getProjectionObject() // to Spherical Mercator Projection
	                  );
	                  
	            var zoom=16;

	            var markers = new OpenLayers.Layer.Markers( "Markers" );
	            map.addLayer(markers);
	            markers.addMarker(new OpenLayers.Marker(lonLat));
	           
	            
	            map.setCenter (lonLat, zoom);
	          </script> 
@endsection


