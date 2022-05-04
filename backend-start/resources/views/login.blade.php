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
    .col-md-2{
        background-color: #ebebeb;
    }
    </style>

    <div class="container-fluid">
        <div class="row vh-100 ">
            <div class="col-md-2 d-md-flex align-items-center justify-content-center " style="border:2px solid #aeaeae;">
                @include('logincomponents.loginform')
            </div>
            <div class="col-md-10 d-md-flex align-items-center  ">
                @include('logincomponents.healthnews')
            </div>
        </div>
    </div>
    
</body>
</html>