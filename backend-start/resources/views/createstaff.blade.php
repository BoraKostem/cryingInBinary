@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

@endsection
@section('content')




<div class="container">
    <div class="row" style="margin-top:45px">
        <div class="col-md-4 col-md-offset-4">
        <h4>Register Staff</h4><hr>
        </div>
    </div>
   <div class="row" style="margin-top:15px">
      <div class="col-md-4 col-md-offset-4">
           <form action="{{route('register.staff')}}" method="post">

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
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title (If Exists)">
                <span class="text-danger">@error('title'){{ $message }} @enderror</span>
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
                 <label>Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Enter password">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary mt-3">Create Staff</button>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <label>Job</label>
            <select class="form-control" name="job">
               <option selected>Please Select The Job Of The Staff</option>
               <option value="doctor">Doctor</option>
               <option value="nurse">Nurse</option>
               <option value="secretary">Secretary</option>
             </select>
            <span class="text-danger">@error('job'){{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label>Speciality (If Exists)</label>
            <select class="form-control" name="speciality">
               <option selected>Please Select Speciality Of The Doctor</option>
               <option value="dentist">Dentist</option>
               <option value="cardiolog">Cardiolog</option>
               <option value="norolog">Norolog</option>
             </select>
            <span class="text-danger">@error('speciality'){{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label>Location</label>
            <select class="form-control" name="location">
               <option selected>Please Select Location Of The Staff</option>
               <option value="main">Main Campus</option>
               <option value="east">East Campus</option>
             </select>
            <span class="text-danger">@error('location'){{ $message }} @enderror</span>
        </div>            
       </form>
      </div>
   </div>
</div>



@endsection