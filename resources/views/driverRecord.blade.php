@extends('layouts.driverApp')
@section('title','Record')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header"><h2><p style="text-align: center;">{{ __('Driver Record') }}</p></h2></div>
               	<div class="table-responsive">
				  	<table class="table table-striped table-hover table-condensed">
					   	<thead>
					      <tr>
					        <th><strong>S.N</strong></th>
					        <th><strong>Owner Name</strong></th>
					        <th><strong>Phone</strong></th>
					        <th><strong>Address</strong></th>
					        <th><strong>Vehicle</strong></th>
					        <th><strong>Start</strong></th>
					        <th><strong>End</strong></th>
					        <th><strong>Cost</strong></th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($tasks as $task)
					    	<tr>
						        <th> {{ $count++ }}</th>
						        <th>{{ $task->name }}</th>
						        <th>{{ $task->phone_number }}</th>
						        <th>{{ $task->address }}</th>
						        <th>{{ $task->behicle_type }}</th>
						        <th>{{ $task->start_time }}</th>
						        <th>{{ $task->end_time }}</th>
						        <th>{{ $task->cost }}</th>					        	
					      	</tr>
					    	@endforeach
					      	
					    </tbody>
					</table>
				</div>
                	
                </div>
            </div>
        </div>
        <div>
			{!! $tasks->links() !!}
		</div>
	</div>
@endsection



