@extends('layouts/__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item">
            Dashboard
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    @include ('_partials.esqolastatistics', ['statistics'=>$statistics])
    <script type="application/javascript">
        $('.dashboard-home').addClass('active');
    </script>
<!--FOMRS -->
        {!!Form::open(['route'=>'add.store', 'method'=>'POST'])!!}
        <div class="form-group">
            {!!Form::label('nombre','Nombre:')!!}
            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Correo:')!!}
            {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('password','Contraseña:')!!}
            {!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
        </div>
        {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
<!--FOMRS -->
@endsection