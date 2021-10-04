<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inicio de Sesi&oacute;n</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <!-- Styles -->
        <style type="text/css">
            html,
            body {
              height: 100%;
            }

            body {
              display: -ms-flexbox;
              display: flex;
              -ms-flex-align: center;
              align-items: center;
              padding-top: 40px;
              padding-bottom: 40px;
              background-color: #f5f5f5;
            }

            .form-signin {
              width: 100%;
              max-width: 330px;
              padding: 15px;
              margin: auto;
            }
            .form-signin .checkbox {
              font-weight: 400;
            }
            .form-signin .form-control {
              position: relative;
              box-sizing: border-box;
              height: auto;
              padding: 10px;
              font-size: 16px;
            }
            .form-signin .form-control:focus {
              z-index: 2;
            }
            .form-signin input[type="text"] {
              margin-bottom: -1px;
              border-bottom-right-radius: 0;
              border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
              margin-bottom: 10px;
              border-top-left-radius: 0;
              border-top-right-radius: 0;
            }
        </style>
    </head>
    <body class="text-center">
        <form class="form-signin" method="post" action="login">
           @csrf
            <div class="jumbotron jumbotron-fluid">
                <div class="container-fluid" style="">
                  <div class="row form-group">
                    <div class="col">
                      <h1 class="h3 mb-3 font-weight-normal">Iniciar sesi&oacute;n</h1>
                    </div>
                  </div>
                <div class="row form-group">
                  <div class="col-4 text-left">
                    <label for="username" class="">Usuario</label>
                  </div>
                  <div class="col-8">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Usuario" required  value="">
                  </div>
                </div>
                <div class="row  form-group">
                  <div class="col-4 text-left">
                    <label for="passwordUser" class="">Contrase&ntilde;a</label>
                  </div>
                  <div class="col-8">
                    <input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Contrase&ntilde;a" required value="">
                  </div>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Recordarme
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesi&oacute;n</button>
                <div class="mb-3">
                    <label>
                      <a href="/forgot_password">Olvid&eacute; mi contrase&ntilde;a</a>
                    </label>
                </div>
                <p class="mt-5 mb-3 text-muted">&copy; Desarrollado por Wilson Andres Majin</p>
                </div>
            </div>
        </form>
    </body>
</html>
