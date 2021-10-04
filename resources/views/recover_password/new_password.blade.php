<!DOCTYPE html>
<html>
<head>
  <title>Olvidé mi Contrase&ntilde;a</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>
  <body>
    <div class="container" role="main">
        <br><br>
        <div class="col-xs-12">
            {{ Form::open(array('url' => '/update_password', 'method'=>'post')) }}
            <div class="card center-block">
                <div class="card-header"> <h3>Nueva contrase&ntilde;a de Acceso</h3> </div>
                <div class="card-body">
                    <p></p>
                    @if(isset($link) && isset($email) && !session()->has('success'))
                        <div class="form-group" class="card-text">
                            <p>
                                Por favor ingrese la nueva contrase&ntilde;a de acceso a la cuenta de email <strong>{{ $email }}.</strong>
                            </p>
                            <label for="password"><strong>Contrase&ntilde;a</strong> </label>
                            <input type="password" id="password" class="form-control" name="password" required placeholder="Ingres la contrase&ntilde;a">

                            <label for="repeat_password"><strong>Repetir Contrase&ntilde;a</strong> </label>
                            <input type="password" id="repeat_password" class="form-control" name="repeat_password" required placeholder="Repita la contrase&ntilde;a">

                            <input type="hidden" name="id" value="{{ $id }}">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Actualizar contrase&ntilde;a" >
                        </div>

                    @else
                        @if(isset($failure))
                            <p>{{ $failure }}</p>
                        @endif
                    @endif

                    @if(isset($failure))
                        <a href="{{ $newLink }}" class="link">Generar nuevo enlace</a>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <strong>{{ session()->get('success') }}</strong>
                        </div>
                        <a href="{{ $login }}" class="link">Iniciar sesi&oacute;n</a>

                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first() }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-3"></div>
    </div> <!-- /container -->
  </body>
</html>