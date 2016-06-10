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
                <tbody>
                    <tr>
                        <td> Usuario </td>
                        <td> {{{ $log->user->full_name()}}}</td>
                    </tr>
                    <tr>
                        <td> Error </td>
                        <td> {{{ $log->error }}} </td>
                    </tr>
                    <tr>
                        <td> Descripción </td>
                        <td> {{{ $log->description }}}  </td>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <td> {{{ $log->error_types->error_name }}} </td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td> {{{ $log->created_at }}} </td>
                    </tr>
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