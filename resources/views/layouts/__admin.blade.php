<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::script('scripts/jquery.js') !!}

    {!! Html::style('semantic-ui/dist/semantic.min.css') !!}
    {!! Html::script('semantic-ui/dist/semantic.min.js') !!}

    {!! Html::style('css/nprogress.css') !!}
    {!! Html::script('scripts/nprogress.js') !!}

    {!! Html::style('css/custom.css') !!}
    {!! Html::script('scripts/app.js') !!}

    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.semanticui.min.js" type="application/javascript"></script>

    <title>Esqola | Administration</title>

</head>
<body id="app-layout">

<div class="top-menu">
    <div class="ui attached large borderless menu icon labeled">
        <div class="right menu labeled icon">
            <a class="item" href="">
                <i class="icon user"></i>
                {{ $user->full_name() }}
            </a>
            <a class="item">
                <i class="icon settings"></i>
            </a>
            <a class="item orange active">
                <i class="icon lightning"></i> 0
            </a>
        </div>
    </div>
</div>
<div class="ui scrollablecontent">
    <div class="left-menu">
        <div class="ui attached vertical menu icon labeled left">
            <a class="ui item orange dashboard-home" href="{!! action('Admin\DashboardController@index') !!}">
                <i class="icon dashboard"></i>
                Dashboard
            </a>
            <a class="ui item orange users-home" href="{!! action('Admin\UsersController@mainUsers') !!}">
                <i class="icon university"></i>
                General
            </a>
            <a class="ui item orange">
                <i class="icon book"></i>
                Notas
            </a>
            <a class="ui item orange">
                <i class="icon file"></i>
                Tareas
            </a>
            <a class="ui item orange">
                <i class="icon content"></i>
                Contenidos
            </a>
            <a class="ui item orange">
                <i class="icon calendar"></i>
                Eventos
            </a>
            <a class="ui item orange">
                <i class="icon setting"></i>
                Ajustes
            </a>
            <a class="ui item orange log-home" href="{!! action('Admin\SystemController@log') !!}">
                <i class="icon browser"></i>
                Log
            </a>
            <a class="ui item orange" href="{!! url('/logout') !!}">
                <i class="icon moon"></i>
                Cerrar Sesión
            </a>
        </div>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</div>

</body>
</html>