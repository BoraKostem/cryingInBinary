@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

@endsection
@section('content')



<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Admin | Change Password</h4><hr>
           <form action="adminC" method="post">

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
                 <label>Old Password</label>
                 <input type="password" class="form-control" name="oldpassword" placeholder="Enter Old Password">
                 <span class="text-danger">@error('oldpassword'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>New Password</label>
                 <input type="password" class="form-control" name="newpassword" placeholder="Enter New password">
                 <span class="text-danger">@error('newpassword'){{ $message }} @enderror</span>
              </div>

              <button type="submit" class="btn btn-block btn-primary mt-3">Save</button>
           </form>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
@endsection