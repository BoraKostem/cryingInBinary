@extends('layouts.app',['userInfo' => $userInfo])


@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript"> //To select Date
   $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        autoclose: true,
        todayHighlight: true, 
     }).val();
   });
</script>
@endsection


@section('content')


<div class="container mt-4">     
    <div class="col-md-4 mb-3" style="border-bottom:2px solid black;">
      <h4>Edit Shift</h4>
    </div>

         @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @if(Session::has('errmessage'))
            <div class="alert bg-danger alert-success text-white" role="alert">
                {{Session::get('errmessage')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
                
            </div>
                
        @endforeach
    
<div class="card mb-5">        
    <form action="{{route('appointment.check')}}" method="post">@csrf

            <div class="card-header">
                Choose date:              
                @if(isset($date))
                    {{$date}}
                @endif
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date" placeholder="Please choose a date">
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-custom">Check</button>
                </div>
              </div>
            </div>
    </form>
  @if(Route::is('appointment.check'))
  <form action="{{route('update')}}" method="post">@csrf
          <div class="card-header">
              Choose a Time
            <span style="margin-left: 700px">Check/Uncheck
                <input type="checkbox" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked" >
            </span>
          </div>
          
          <div class="card-body">
              
              <table class="table table-striped">
              
                
                <tbody>
                <input type="hidden" value="{{$appointmentID}}" name="appointmentID">
                  <tr>
                    <th scope="row">1</th>
                    <td><input type="checkbox" name="time[]"  value="8.00"@if(isset($times)){{$times->contains('time','8.00')?'checked':''}}@endif>8.00</td>
                    <td><input type="checkbox" name="time[]"  value="8.20"@if(isset($times)){{$times->contains('time','8.20')?'checked':''}}@endif>8.20</td>
                    <td><input type="checkbox" name="time[]"  value="8.40"@if(isset($times)){{$times->contains('time','8.40')?'checked':''}}@endif>8.40</td>
                  </tr>

                  <tr>
                    <th scope="row">2</th>
                    <td><input type="checkbox" name="time[]"  value="9.00"@if(isset($times)){{$times->contains('time','9.00')?'checked':''}}@endif>9.00</td>
                    <td><input type="checkbox" name="time[]"  value="9.20"@if(isset($times)){{$times->contains('time','9.20')?'checked':''}}@endif>9.20</td>
                    <td><input type="checkbox" name="time[]"  value="9.40"@if(isset($times)){{$times->contains('time','9.40')?'checked':''}}@endif>9.40</td>
                  </tr>

                  <tr>
                    <th scope="row">3</th>
                    <td><input type="checkbox" name="time[]"  value="10.00"@if(isset($times)){{$times->contains('time','10.00')?'checked':''}}@endif>10.00</td>
                    <td><input type="checkbox" name="time[]"  value="10.20"@if(isset($times)){{$times->contains('time','10.20')?'checked':''}}@endif>10.20</td>
                    <td><input type="checkbox" name="time[]"  value="10.40"@if(isset($times)){{$times->contains('time','10.40')?'checked':''}}@endif>10.40</td>
                  </tr>

                  <tr>
                    <th scope="row">4</th>
                    <td><input type="checkbox" name="time[]"  value="11.00"@if(isset($times)){{$times->contains('time','11.00')?'checked':''}}@endif>11.00</td>
                    <td><input type="checkbox" name="time[]"  value="11.20"@if(isset($times)){{$times->contains('time','11.20')?'checked':''}}@endif>11.20</td>
                    <td><input type="checkbox" name="time[]"  value="11.40"@if(isset($times)){{$times->contains('time','11.40')?'checked':''}}@endif>11.40</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td><input type="checkbox" name="time[]"  value="12.00"@if(isset($times)){{$times->contains('time','12.00')?'checked':''}}@endif>12.00</td>
                    <td><input type="checkbox" name="time[]"  value="12.20"@if(isset($times)){{$times->contains('time','12.20')?'checked':''}}@endif>12.20</td>
                    <td><input type="checkbox" name="time[]"  value="12.40"@if(isset($times)){{$times->contains('time','12.40')?'checked':''}}@endif>12.40</td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td><input type="checkbox" name="time[]"  value="13.00"@if(isset($times)){{$times->contains('time','13.00')?'checked':''}}@endif>13.00</td>
                    <td><input type="checkbox" name="time[]"  value="13.20"@if(isset($times)){{$times->contains('time','13.20')?'checked':''}}@endif>13.20</td>
                    <td><input type="checkbox" name="time[]"  value="13.40"@if(isset($times)){{$times->contains('time','13.40')?'checked':''}}@endif>13.40</td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td><input type="checkbox" name="time[]"  value="14.00"@if(isset($times)){{$times->contains('time','14.00')?'checked':''}}@endif>14.00</td>
                    <td><input type="checkbox" name="time[]"  value="14.20"@if(isset($times)){{$times->contains('time','14.20')?'checked':''}}@endif>14.20</td>
                    <td><input type="checkbox" name="time[]"  value="14.40"@if(isset($times)){{$times->contains('time','14.40')?'checked':''}}@endif>14.40</td>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td><input type="checkbox" name="time[]"  value="15.00"@if(isset($times)){{$times->contains('time','15.00')?'checked':''}}@endif>15.00</td>
                    <td><input type="checkbox" name="time[]"  value="15.20"@if(isset($times)){{$times->contains('time','15.20')?'checked':''}}@endif>15.20</td>
                    <td><input type="checkbox" name="time[]"  value="15.40"@if(isset($times)){{$times->contains('time','15.40')?'checked':''}}@endif>15.40</td>
                  </tr>
                  <tr>
                    <th scope="row">9</th>
                    <td><input type="checkbox" name="time[]"  value="16.00"@if(isset($times)){{$times->contains('time','16.00')?'checked':''}}@endif>16.00</td>
                    <td><input type="checkbox" name="time[]"  value="16.20"@if(isset($times)){{$times->contains('time','16.20')?'checked':''}}@endif>16.20</td>
                    <td><input type="checkbox" name="time[]"  value="16.40"@if(isset($times)){{$times->contains('time','16.40')?'checked':''}}@endif>16.40</td>
                  </tr>
                  <tr>
                    <th scope="row">10</th>
                    <td><input type="checkbox" name="time[]"  value="17.00"@if(isset($times)){{$times->contains('time','17.00')?'checked':''}}@endif>17.00</td>
                    <td><input type="checkbox" name="time[]"  value="17.20"@if(isset($times)){{$times->contains('time','17.20')?'checked':''}}@endif>17.20</td>
                    <td><input type="checkbox" name="time[]"  value="17.40"@if(isset($times)){{$times->contains('time','17.40')?'checked':''}}@endif>17.40</td>
                  </tr>
                </tbody>
              </table>
          </div>
          <div class="card-footer text-end">
              <button type="submit" class="btn btn-custom">Submit</button>
          </div>
      </div>
      
    </form>

  @else 
  </div>
    <h4 class="mt-4">Your Schedule Lists: {{$appointments->count()}}</h4>

          <table class="table table-striped" style="border-top: 2px solid black">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Creator</th>
                <th scope="col">Date</th>
                <th scope="col">View/Update</th>
              </tr>
            </thead>
            <tbody>

              @foreach($appointments as $appointment)
              <tr>
              
                <th scope="row"></th>
                <td>{{App\Models\Staff::where('id','=', $appointment->user_id)->first()->name}}</td>
                <td>{{$appointment->date}}</td>
                <td>
                      <form action="{{route('appointment.check')}}" method="post">@csrf
                          <input type="hidden" name="date" value="{{$appointment->date}}">
                      <button type="submit" class="btn btn-primary">View/Update</button>


                      </form>


                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    
  @endif

</div>


<style type="text/css">
    input[type="checkbox"]{
        zoom:1.1;
   
    }
    body{
        font-size: 18px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection