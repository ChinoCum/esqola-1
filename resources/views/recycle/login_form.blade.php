<div class="ui attached segments">
    <div class="ui segment center aligned"> <div class="ui header orange">ESQOLA</div> </div>
    <div class="ui segment">
        <form class="ui form error" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            @if (count($errors) > 0)
                <div class="ui error message">
                    <!--<div class="header"> Errores </div>-->
                    <li> Datos incorrectos </li>
                    </ul>
                </div>
            @endif
            <div class="required field">
                <label> Email </label>
                <input type="text" class="email" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>

            <div class="required field">
                <label>Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="remember" />
                    <label>Recordarme</label>
                </div>
            </div>
            <div class="field align-to-right">
                    <button type="submit" class="ui basic submit animated button">
                        <div class="visible content">Iniciar Sesión</div>
                        <div class="hidden content">
                            <i class="right arrow icon"></i>
                        </div>
                    </button>
            </div>

        </form>
    </div>
    <div class="ui bottom attached warning message">
        <i class="icon help"></i>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidé mi contraseña</a>
    </div>
</div>

<script type="application/javascript">
    $('input.email').focus();
    $('.ui.button.submit').click(function () {
        $(this).addClass('loading')
    });
</script>
