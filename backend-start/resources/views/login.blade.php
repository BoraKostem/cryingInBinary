<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{config('app.name', 'LSAPP')}}</title>
</head>
<body>

    <style>
        .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
            background-color: #003366 !important;
            color: #fff;
        }
    </style>


    <div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-4 cold-md-offset-4">
                <h4>Bilkent Health Center</h4>
                <form action="user" method="POST">
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                    
                    @csrf
                    <div class="form-group">
                        <label>Bilkent ID</label>
                        <input type="text" class="form-control mt-1" name="bilkentID" placeholder="Bilkent ID">
                        <span class="text-danger">@error('bilkentID'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control mt-1" name="password" placeholder="Password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-custom btn-sm mt-3">Login</button>
                    <br>
                    <a href="">Forgot My Password</a>
                </form>

            </div>
        </div>
    </div>







</body>
</html>