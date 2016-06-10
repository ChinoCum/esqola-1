@extends('layouts/__admin')
@section('content')
    <div class="ui segments">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Usuarios
            </div>
            <a class="ui icon labeled item right aligned primary" href="{!! action('adminController@addUser') !!}">
                <i class="icon add"></i>
                Agregar
            </a>
        </div>
        <div class="ui segment">
            <table class="ui celled table">
                <thead>
                    <th class="collapsing">Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                    @foreach($users as $current_user)
                        <tr>
                            <td> {!! $current_user->id !!} </td>
                            <td> {!! $current_user->full_name() !!} </td>
                            <td> {!! $current_user->email !!} </td>
                            <td> {!! $current_user->roles()->pluck('name') !!} </td>
                            <td>
                                <a href="{!! action('adminController@removeUser',['email'=>$current_user->email]) !!}" class=" yesnomodallink">
                                    <i class="icon delete compact"></i>
                                </a>
                                <a href="{!! action('adminController@removeUser',['email'=>$current_user->email]) !!}" class=" yesnomodallink">
                                    <i class="icon delete compact"></i>
                                </a>
                            </td>
                        </tr>
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
            <a class="ui icon labeled item right aligned primary">
                <i class="icon add"></i>
                Agregar
            </a>
        </div>
        <div class="ui segment">
            <table class="ui celled table">
                <thead>
                <th class="collapsing">Id</th>
                <th>Rol</th>
                <th class="collapsing">Acciones</th>
                </thead>
                <tbody>
                @foreach($roles as $current_role)
                    <tr>
                        <td> {!! $current_role->id !!} </td>
                        <td> {!! $current_role->name !!} </td>
                        <td>
                            <a href="">
                                <i class="icon delete compact"></i>
                            </a>
                        </td>
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
    </script>
@endsection