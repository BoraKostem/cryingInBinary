<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>{{config('app.name', 'LSAPP')}}</title>
    @yield('style')
</head>
<body>
    @include('extras.navbar',['userInfo'=> $userInfo])
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-md-2 d-md-flex justify-content-center" >
                <div class="col-md-8 d-md-flex justify-content-center me-auto">
                    @include('extras.profilebar',['userInfo'=> $userInfo])
                </div>
            </div>    
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>