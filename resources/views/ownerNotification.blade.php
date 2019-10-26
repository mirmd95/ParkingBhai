@extends('layouts.ownerApp')
@section('title','Owner Notification')
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
							<b style="color: #333300;">Vehicle: </b>{{ $task->behicle_type }}<br>
							<b style="color: #333300;">License No: </b>{{ $task->license_no }}<br>
							<a href="{{ route('park.request.accept',['id'=>$task->id] ) }}"><button class="button btn-dark">Accept</button></a>
							<a href="{{ route('park.request.reject',['id'=>$task->id] ) }}"><button class="button btn-dark">Reject</button></a>
						</div>
						   
					</div>
					<br>
				</div>
				<div class="col-md-3"></div>
			@endforeach		
		</div>	
	</div>
@endsection



