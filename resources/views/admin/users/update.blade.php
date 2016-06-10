@extends('layouts/__admin')
@section('content')
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
               Editar Usuario
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\UsersController@updateUser') !!}">
                {!! csrf_field() !!}
                <h4 class="ui horizontal header divider">
                    General
                </h4>
                <input type="hidden" name="auth" value="{!! $update_user->uuid !!}"/>
                <div class="field">
                    <label class="ui"> Código </label>
                    <input type="text" name="bk" value="{{{ $update_user->BK or ""}}}">
                </div>
                <div class="required field">
                    <label class="ui"> Nombre </label>
                    <input type="text" name="Nombre" value="{{{ $update_user->name or ""}}}">
                </div>
                <div class="required field">
                    <label class="ui"> Apellido </label>
                    <input type="text" name="Apellido" value="{{{ $update_user->lastname or "" }}}">
                </div>
                <div class="required field">
                    <label class="ui"> Email </label>
                    <input type="text"  name="Email" value="{{{ $update_user->email or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Teléfono </label>
                    <input type="number" name="Telefono" value="{{{ $update_user->telephone or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Dirección </label>
                    <input type="text" name="address" value="{{{ $update_user->address or "" }}}">
                </div>
                <div class="field">
                    <label class="ui"> Edad </label>
                    <input type="number" name="Edad" value="{{{ $update_user->age or "" }}}">
                </div>
                <div class="field">
                    <label>Rol</label>
                    <select class="ui dropdown normal" name="role" selected="1">
                        <option class="ui" value="Estudiante">Estudiante</option>
                        <option class="ui" value="Maestro">Maestro</option>
                    </select>
                </div>
                <h4 class="ui horizontal header divider">Información </h4>
                <div class="field">
                    <label class="ui"> Encargado </label>
                    <input type="text" name="encargado" value="{{{ $update_user->attribute->incharge  }}}">
                </div>
                <div class="field">
                    <label class="ui"> Información encargado </label>
                    <textarea rows="2" name="infoEncargado">{{{$update_user->attribute->incharge_info}}}</textarea>
                </div>
                <div class="field align-to-right">
                    <button class="ui basic submit button">
                        <i class="icon add"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
    </script>
@endsection