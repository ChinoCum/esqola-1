@extends('layouts/__admin')
@section('content')
    <div class="ui secondary pointing menu">
        <a class="active item">
            Log
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
                Log
            </div>
        </div>
        <div class="ui segment">
            <table class="ui fixed table selectable" id="users-table">
                <thead>
                <th class="collapsing">Usuario</th>
                <th>Log</th>
                <th>Descripción</th>
                <th class="collapsing">Tipo</th>
                <th class="collapsing">Fecha</th>
                </thead>
                <tbody>
                @foreach($logs as $key => $log)
                    <tr>
                        <td> {{{ $log->user->full_name()}}}</td>
                        <td> <a href="{{{ action('Admin\SystemController@LogDescription', $log->id) }}}">{{{ $log->error }}}</a> </td>
                        <td> <a href="{{{ action('Admin\SystemController@LogDescription', $log->id) }}}">{{{ str_limit($log->description, 100) }}}</a>  </td>
                        <td> {{{ $log->error_types->error_name }}} </td>
                        <td> {{{ $log->created_at }}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
        $('.log-home').addClass('active');
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