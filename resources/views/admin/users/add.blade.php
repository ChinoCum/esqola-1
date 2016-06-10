@extends('layouts/__admin')
@section('content')
    <div class="ui text menu">
        <a class="item" href="{!! action('Admin\UsersController@mainUsers') !!}">
            <button class="ui button basic active"><i class="icon angle left ui"></i> Regresar</button>
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
               Agregar Usuario
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\UsersController@createUser') !!}">
                {!! csrf_field() !!}
                <h4 class="ui horizontal header divider">
                    General
                </h4>
                    <div class="required field">
                        <label class="ui"> Código </label>
                        <input type="text" name="bk" value="{{ old('bk') }}">
                    </div>
                    <div class="required field">
                        <label class="ui"> Nombre </label>
                        <input type="text" name="Nombre" value="{{ old('Nombre') }}">
                    </div>
                    <div class="required field">
                        <label class="ui"> Apellido </label>
                        <input type="text" name="Apellido" value="{{ old('Apellido') }}">
                    </div>

                    <div class="required field">
                        <label class="ui"> Email </label>
                        <input type="text" name="Email" value="{{ old('Email') }}">
                    </div>
                    <div class="field">
                        <label class="ui"> Teléfono </label>
                        <input type="number" name="Telefono" value="{{ old('Telefono') }}">
                    </div>

                    <div class="field">
                        <label class="ui"> Dirección </label>
                        <input type="text" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="field">
                        <label class="ui"> Edad </label>
                        <input type="number" name="Edad" value="{{ old('Edad') }}">
                    </div>

                    <div class="required field">
                        <label class="ui"> Contraseña (6 caracteres mínimo) </label>
                        <input type="password" name="Contraseña">
                    </div>
                    <div class="required field">
                        <label class="ui"> Confirmar Contraseña </label>
                        <input type="password" name="Contraseña_confirmation">
                    </div>
                <div class="field">
                    <label>Rol</label>
                    <select class="ui dropdown normal" name="role">
                        @foreach($roles as $role)
                            <option class="ui" value="{{{$role->name}}}">{{{$role->name}}}</option>
                        @endforeach
                    </select>
                </div>
                <h4 class="ui horizontal header divider">Información </h4>
                <div class="field">
                    <label class="ui"> Encargado </label>
                    <input type="text" name="encargado">
                </div>
                <div class="field">
                    <label class="ui"> Información encargado </label>
                    <textarea rows="2" name="infoEncargado"></textarea>
                </div>
                <div class="field align-to-right">
                    <button class="ui orange submit button">
                        <i class="icon add"></i>Añadir
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
    </script>
@endsection