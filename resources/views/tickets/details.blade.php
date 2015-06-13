@extends('layout')

@section('content')
        
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="title-show">
                    {{ $ticket->title }}
                    @include('tickets/partials/status', compact('ticket'))

                </h2>
                <p class="date-t">
                    <span class="glyphicon glyphicon-time"></span>
                    {{ $ticket->created_at->format('d/m/Y h:ia') }}
                </p>
                <h4 class="label label-info news">
                    {{ count($ticket->voters) }} votos
                </h4>

                <p class="vote-users">
                    @foreach ($ticket->voters as $user)
                        <span class="label label-info">{{ $user->name }}</span>
                    @endforeach
                </p>

                {!! Form::open(['method'=>'POST', 'route'=>['votes.submit', $ticket->id] ]) !!}
                
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                    </button>
                
                {!! Form::close() !!}

                {!! Form::open(['method'=>'DELETE', 'route'=>['votes.destroy', $ticket->id] ]) !!}
                
                    <button type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Quitar voto
                    </button>
                
                {!! Form::close() !!}

                <h3>Nuevo Comentario</h3>

                {!! Form::open(['method'=>'POST', 'route'=>['comentar.create', $ticket->id] ]) !!}
                
                    <div class="form-group">
                        {!! Form::label('comment', 'Comentarios:') !!}
                        {!! Form::textarea('comment', null, ['cols'=>'50','rows'=>'4','class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('link', 'Enlace:') !!}
                        {!! Form::text('link', null, ['class'=>'form-control']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enviar comentario
                    </button>
                
                {!! Form::close() !!}


                <h3>Comentarios ({{ count($ticket->comments) }})</h3>
                
                @foreach ($ticket->comments as $comment)
                    <div class="well well-sm">
                        <p><strong>{{ $comment->user->name }}</strong></p>
                        <p>{{ $comment->comment }}</p>
                        <p class="date-t"><span class="glyphicon glyphicon-time"></span>
                            {{ $comment->created_at->format('d/m/Y h:ia') }}
                        </p>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

@endsection
