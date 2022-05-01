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

<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Register | Custom Auth</h4><hr>
           <form action="registerUser" method="post">

           @if(Session::get('success'))
             <div class="alert alert-success">
                {{ Session::get('success') }}
             </div>
           @endif

           @if(Session::get('fail'))
             <div class="alert alert-danger">
                {{ Session::get('fail') }}
             </div>
           @endif

           @csrf
               <div class="form-group">
                 <label>Bilkent ID</label>
                 <input type="text" class="form-control" name="bilkentID" placeholder="Enter BilkentID">
                 <span class="text-danger">@error('bilkentID'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Name</label>
                 <input type="text" class="form-control" name="name" placeholder="Enter full name">
                 <span class="text-danger">@error('name'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Email</label>
                 <input type="text" class="form-control" name="email" placeholder="Enter email address">
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                <label>Phome Number</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
             </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Enter password">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>

              <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
           </form>
      </div>
   </div>
</div>
    
</body>
</html>