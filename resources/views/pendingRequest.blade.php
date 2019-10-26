@extends('layouts.driverApp')
@section('title','Pending Request')
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
						   	<b style="color: #333300;">Area: </b>{{ $task->Area }}<br>
						  	<b style="color: #333300;">Address: </b>{{ $task->address }}<br>
						  	<a href="{{ route('park.request.cancel',['id'=>$task->id] ) }}"><button class="button btn-dark">Cancel Request</button></a>
						   
						</div>
						   
					</div>
					<br>
				</div>
				<div class="col-md-3"></div>
			@endforeach		
		</div>	
	</div>
@endsection



