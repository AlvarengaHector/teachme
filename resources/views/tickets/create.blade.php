@extends('layout')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>Nueva solicitud</h2>
				{!! Form::open(['method'=>'post', 'route'=>'tickets.store' ]) !!}
				
				    boottext
				
					<div class="btn-group pull-right">
						{!! Form::reset("Reset", ['class'=>'btn btn-warning']) !!}
						{!! Form::submit("Enviar", ['class'=>'btn btn-success']) !!}
					</div>
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection