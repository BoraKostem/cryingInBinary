@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript"> //To select Date
   $(function() {
     $( "#datepicker" ).datepicker({
      format: "mm/dd/yy",
      autoclose: true,
      todayHighlight: true, 
     });
   });
</script>
@endsection

@section('content')




<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Register Patient</h4><hr>
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
                  <label>Gender</label>
                  <select class="form-control" name="gender">
                     <option selected>Please Select A Gender</option>
                     <option value="Male">Male</option>
                     <option value="Female">Female</option>
                   </select>
                  <span class="text-danger">@error('gender'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Email</label>
                 <input type="text" class="form-control" name="email" placeholder="Enter email address">
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
             </div>
             <div class="form-group">
               <label>Birthday</label>
               <div class="input-group">
                  <input type="text" class="form-control" id="datepicker" name="date" placeholder="Enter Birthday"/>
               </div>
               <span class="text-danger">@error('date'){{ $message }} @enderror</span>
             </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Enter password">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>

              <button type="submit" class="btn btn-block btn-primary mt-2">Create User</button>
           </form>
      </div>
   </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection