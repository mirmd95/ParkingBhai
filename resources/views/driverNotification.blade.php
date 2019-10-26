@extends('layouts.driverApp')
@section('title','Driver Notification')
@section('content')
	<div class="container">
		<div class="row">
			@foreach($tasks as $task)
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="card" style="width: 500px;">
						<div class="card-body">
							<b style="color: #333300;">Name: </b>{{ $task->name }}<br>
							<b style="color: #333300;">Phone: </b>{{ $task->phone_number }}<br>
							<b style="color: #333300;">Address: </b>{{ $task->address }}<br>
							<button class="button btn-success">Parking is Ready For You</button>
							<a href="#"><button class="button btn-dark">View Cost</button></a>
						</div>	   
					</div>
					<br>
				</div>
				<div class="col-md-3"></div>
			@endforeach		
		</div>	
	</div>
@endsection



