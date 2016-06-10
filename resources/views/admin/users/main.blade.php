@extends('layouts/__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item">
            Usuarios
        </a>
        <a class="item" href="{!! action('Admin\GradesController@index') !!}">
            Grados
        </a>
        <a class="item">
            Materias
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments ">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Usuarios
            </div>
            <a class="ui icon labeled item right aligned primary" href="{!! action('Admin\UsersController@addUser') !!}">
                <i class="icon add"></i>
                Agregar
            </a>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable" id="users-table">
                <thead>
                    <th class="collapsing">#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                    @foreach($users as $key => $current_user)
                        @if(!$current_user->hasRole('admin'))
                        <tr>
                            <td> {{{ $key+1 }}} </td>
                            <td> {{{ $current_user->full_name() }}} </td>
                            <td> {{{ $current_user->email }}} </td>
                            <td> {{{ $current_user->roles()->pluck('name') }}} </td>
                            <td>
                                <div class="ui floating labeled icon dropdown button">
                                    <i class="wizard icon"></i>
                                    <span class="text">Acciones</span>
                                    <div class="menu">
                                        <div class="header">
                                            <i class="list layout icon"></i>
                                            Opciones
                                        </div>
                                        <div class="divider"></div>
                                        <div class="item" data-value="{!! action('Admin\UsersController@editUser',['uuid'=>$current_user->uuid]) !!}">
                                            Configuración
                                        </div>
                                        <div class="item" data-value="{!! action('Admin\UsersController@removeUser',['uuid'=>$current_user->uuid]) !!}">
                                            Eliminar
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Roles
            </div>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable">
                <thead>
                <th class="collapsing">#</th>
                <th>Rol</th>
                </thead>
                <tbody>
                @foreach($roles as $key => $current_role)
                    <tr>
                        <td> {{{ $key+1 }}} </td>
                        <td> {{{ $current_role->name }}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="ui modal small">
        <div class="header">¿Desea continuar?</div>
        <div class="actions">
            <div class="ui cancel onDeny button">Cancelar</div>
            <div class="ui approve red button">Eliminar</div>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
        $('.ui.dropdown').dropdown({
            onChange: function (value, text) {
                if(text === 'Eliminar') {
                    $('.ui.modal').modal('setting', {
                        closable: false,
                        onApprove: function () {
                            window.location = value;
                        }
                    }).modal('show');
                }else {
                    window.location.href = value;
                }
            }
        });
    </script>
@endsection