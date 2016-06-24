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
@endsection