<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLINDIN || LOGIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        body{
            height: 100vh
        }

        .row{
            height: 100vh;
        }
    </style>
</head>
<body class="bg-primary">
    <div class="container">
        <div class="row ">
                <div class="col-lg-7 bg-primary">
                </div>
                <div class="col-lg-5 mt-5" >
                    <div class="">
                        <div class="card p-5 pt-3 mx-5 mt-5">
                        <img src="{{asset('storage')}}/images/user.png" width=80 class="mx-auto mb-3" alt="">
                        <div class="form-group">
                        <form action="{{url('/login')}}" method="post">
                        @csrf
                            <div class="from-group">
                                <label for="email">Correo electrónico</label>
                                <input type="email" class="form-control" name="correo">
                            </div>

                            <div class="from-group">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <button class="btn btn-success btn-block mt-3" type="submit">Ingresar</button>
                        </form>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
</body>
</html>