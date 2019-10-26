@extends('layouts.driverApp')
@section('title','Driver Home')
@section('content')
	<div class="container">
	    <div class="row">
	    	<div class="col-md-3">
	    		<div class="card" style="height: 300px">
	    			<div class="card title" style="text-align: center;">
	    				<h4><b style="color:#545557;">Search Parking Lot</b></h4>
	    			</div>
	    			<div class="card-body">
	    				<form method="POST" action="{{ route('driver.search') }}">
	                        @csrf

	                        
                            <label for="area" class=" col-form-label text-md-right">{{ __('Area') }}</label>

                             <div >
                              <select id="area" type="text" class="form-control {{  $errors->has('area') ? ' is-invalid' : '' }}" name="area"  >
                                <option>Mirpur</option>
                                <option>Dhanmondi</option>
                                <option>Uttara</option>
                              </select>
                            </div> 

                            <label for="behicle" class=" col-form-label text-md-right">{{ __('Behicle Type') }}</label>

                             <div >
                              <select id="area" type="text" class="form-control {{  $errors->has('area') ? ' is-invalid' : '' }}" name="behicle"  >
                                <option>Car</option>
                                <option>Bike</option>
                              </select>
                            </div> 




	                        <div class="form-group row mb-0">
	                            <div >
	                                <button type="submit" class="btn btn-primary">
	                                    {{ __('Search') }}
	                                </button>
	                            </div>
	                        </div>
	                    </form>
	    			</div>
	    		</div>
	    	</div>
        	<div class="col-md-6">
         		<div id="mapdiv" style="height: 450px ;width: 550px"></div>
    		</div>
	       <div class="col-md-3">
	    		<div class="card s" style="height: 450px">
	    			<div class="card title" style="text-align: center;">
	    				<h4><b style="color:#545557;">Searching Result</b></h4>
	    			</div>
	    			<div class="overflow-auto">
		    			<div class="card-body">
					        <h4 "><strong>No Result</strong></h4>
					        <p>Please Search First!!!</p>
					      </div>
					</div>
	    		</div>
	    	</div>
	    </div>
	</div>

              
	<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
	          <script>
	            map = new OpenLayers.Map("mapdiv");
	            map.addLayer(new OpenLayers.Layer.OSM());

	            var lonLat = new OpenLayers.LonLat( 90.3541552 ,23.8139117 )
	                  .transform(
	                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
	                    map.getProjectionObject() // to Spherical Mercator Projection
	                  );
	                  
	            var zoom=16;

	            // var markers = new OpenLayers.Layer.Markers( "Markers" );
	            // map.addLayer(markers);
	            // markers.addMarker(new OpenLayers.Marker(lonLat));
	           
	            
	            map.setCenter (lonLat, zoom);
	          </script> 
@endsection

