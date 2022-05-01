<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{config('app.name', 'LSAPP')}}</title>
</head>
<body>
    @include('extras.navbar',['userInfo'=> $userInfo])
    @include('extras.profilebar',['userInfo'=> $userInfo])
    <div class="container">
        @yield('content')
    </div>

</body>
</html>