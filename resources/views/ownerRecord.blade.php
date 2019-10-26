@extends('layouts.ownerApp')
@section('title','Record')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header"><h2><p style="text-align: center;">{{ __('Owner Record') }}</p></h2></div>
               	<div class="table-responsive">
				  	<table class="table table-striped table-hover table-condensed">
					   	<thead>
					      <tr>
					        <th><strong>S.N</strong></th>
					        <th><strong>Driver Nama</strong></th>
					        <th><strong>Phone</strong></th>
					        <th><strong>Hour</strong></th>
					        <th><strong>Cost</strong></th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($tasks as $task)
					    	<tr>
						        <th> {{ $count++ }}</th>
						        <th>{{ $task->name }}</th>
						        <th>{{ $task->phone_number }}</th>
						        <th>{{ $task->hour }}</th>
						        <th>{{ $task->cost }}</th>
					      	</tr>
					    	@endforeach
					      	{{--   --}}
					    </tbody>
					</table>
				</div>
                	
                </div>
            </div>
        </div>
        {{-- <div>
			{!! $tasks->links() !!}
		</div> --}}
	</div>
@endsection



