@extends('layouts/__admin')
@section('content')
    <div class="ui text menu">
        <a class="item" href="{!! action('Admin\GradesController@index') !!}">
            <button class="ui button basic active"><i class="icon angle left ui"></i> Regresar</button>
        </a>
        <div class="right menu">
            <div class="item">
                <h5 class="ui header"> {!! Breadcrumbs::renderIfExists() !!}</h5>
            </div>
        </div>
    </div>
    <div class="ui segments small-form">
        <div class="ui menu attached right icon labeled aligned">
            <div class="ui header item borderless">
                Agregar Grado
            </div>
        </div>
        <div class="ui segment">
            @include ('_partials.formerrors')
            @if(isset($status))
                <div class="ui {{$status->created}} message">
                    <li>{{ $status->message }}</li>
                </div>
            @endif
            <form method="post" class="ui form error" role="form" action="{!! action('Admin\GradesController@update') !!}">
                {!! csrf_field() !!}
                {{ Form::hidden('auth', $grade->uuid) }}
                <div class="required field">
                    <label class="ui"> Grado </label>
                    <input type="text" name="Grado" value="{{{ $grade->name }}}">
                </div>
                <div class="field align-to-right">
                    <button class="ui button orange active submit">
                        <i class="icon add"></i>Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('.users-home').addClass('active');
    </script>
@endsection