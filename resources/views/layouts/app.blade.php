<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::script('scripts/jquery.js') !!}

    {!! Html::style('semantic-ui/dist/semantic.min.css') !!}
    {!! Html::script('semantic-ui/dist/semantic.min.js') !!}

    {!! Html::style('css/custom.css') !!}

    <title>Esqola {{$seo->title or ''}}</title>

</head>
<body id="app-layout">


    @yield('content')

</body>
</html>
