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
           <h4>Edit Profile</h4><hr>
           <form action="{{route('edtPrflInf')}}" method="post" enctype="multipart/form-data">

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
                 <input type="text" class="form-control" name="bilkentID" placeholder="Enter BilkentID" value="{{$userInfo['bilkentID']}}" readonly>
              </div>
              <div class="form-group">
                 <label>Name</label>
                 <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{$userInfo['name']}}" readonly>
              </div>
              <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control" name="gender" value="{{$userInfo['gender']}}" readonly>
                     <option selected>{{$userInfo['gender']}}</option>
                   </select>
              </div>
              <div class="form-group">
                 <label>Email</label>
                 <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{$userInfo['email']}}">
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="{{$userInfo['phone']}}">
                <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
             </div>
             <div class="form-group">
                <label>HES-Code</label>
                <input type="text" class="form-control" name="hescode" placeholder="Enter HES Code" value="{{$userInfo['hescode']}}">
                <span class="text-danger">@error('hescode'){{ $message }} @enderror</span>
             </div>
             <div class="form-group">
               <label>Birthday</label>
               <div class="input-group">
                  <input type="text" class="form-control" id="datepicker" name="date" placeholder="Enter Birthday" value="{{$userInfo['birthday']}}" readonly/>
               </div>
               <span class="text-danger">@error('date'){{ $message }} @enderror</span>
             </div>
              <div class="form-group">
                 <label>Height</label>
                 <input type="text" class="form-control" name="height" placeholder="Enter your height" value="{{$userInfo['height']}}">
                 <span class="text-danger">@error('height'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                <label>Blood Type</label>
                <input type="text" class="form-control" name="blood_type" placeholder="Enter your blood type" value="{{$userInfo['blood_type']}}">
                <span class="text-danger">@error('blood_type'){{ $message }} @enderror</span>
             </div>
              <div class="form-group">
                <label>Weight</label>
                <input type="text" class="form-control" name="weight" placeholder="Enter your height" value="{{$userInfo['weight']}}">
                <span class="text-danger">@error('weight'){{ $message }} @enderror</span>
             </div>
             <div class="form-group">
                <label>Change Profile Photo</label>
                <input type="file" class="form-control" name="profilephoto" placeholder="Upload a file">
                <span class="text-danger">@error('profilephoto'){{ $message }} @enderror</span>
             </div>

              <button type="submit" class="btn btn-block btn-primary mt-2">Save Changes</button>
           </form>
      </div>
   </div>
</div>



@endsection