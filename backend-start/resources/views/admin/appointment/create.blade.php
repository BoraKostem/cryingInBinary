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


<div class="container mt-3">
        <div class="row">
          <div class="col-md-4" style="border-bottom:1px solid black;">
            <h4>Create New Shift</h4>
        </div>

        </div>
         @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
                
            </div>
                
        @endforeach
    
        
    <div class="row mt-3">
      <form action="{{route('appointment.store')}}" method="post">@csrf
 
        <div class="card">
            <div class="card-header">
                Choose date
    
            </div>
            <div class="input-group">
              <input type="text" class="form-control" id="datepicker" name="date" placeholder="Choose Date"/>
           </div>

    

            <div class="card-header">
                Choose morning time
               <span style="margin-left: 700px">Check/Uncheck
                   <input type="checkbox" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked" >
               </span>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                  <tbody>
                    
                     <tr>
                      <th scope="row">1</th>
                      <td><input type="checkbox" name="time[]"  value="8.00">8.00</td>
                      <td><input type="checkbox" name="time[]"  value="8.20">8.20</td>
                      <td><input type="checkbox" name="time[]"  value="8.40">8.40</td>
                    </tr>
    
                    <tr>
                      <th scope="row">2</th>
                      <td><input type="checkbox" name="time[]"  value="9.00">9.00</td>
                      <td><input type="checkbox" name="time[]"  value="9.20">9.20</td>
                      <td><input type="checkbox" name="time[]"  value="9.40">9.40</td>
                    </tr>
    
                    <tr>
                      <th scope="row">3</th>
                      <td><input type="checkbox" name="time[]"  value="10.00">10.00</td>
                      <td><input type="checkbox" name="time[]"  value="10.20">10.20</td>
                      <td><input type="checkbox" name="time[]"  value="10.40">10.40</td>
                    </tr>
    
                    <tr>
                      <th scope="row">4</th>
                      <td><input type="checkbox" name="time[]"  value="11.00">11.00</td>
                      <td><input type="checkbox" name="time[]"  value="11.20">11.20</td>
                      <td><input type="checkbox" name="time[]"  value="11.40">11.40</td>
                    </tr>

                    <tr>
                      <th scope="row">5</th>
                      <td><input type="checkbox" name="time[]"  value="12.00">12.00</td>
                      <td><input type="checkbox" name="time[]"  value="12.20">12.20</td>
                      <td><input type="checkbox" name="time[]"  value="12.40">12.40</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td><input type="checkbox" name="time[]"  value="13.00">13.00</td>
                      <td><input type="checkbox" name="time[]"  value="13.20">13.20</td>
                      <td><input type="checkbox" name="time[]"  value="13.40">13.40</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td><input type="checkbox" name="time[]"  value="14.00">14.00</td>
                      <td><input type="checkbox" name="time[]"  value="14.20">14.20</td>
                      <td><input type="checkbox" name="time[]"  value="14.40">14.40</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td><input type="checkbox" name="time[]"  value="15.00">15.00</td>
                      <td><input type="checkbox" name="time[]"  value="15.20">15.20</td>
                      <td><input type="checkbox" name="time[]"  value="15.40">15.40</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td><input type="checkbox" name="time[]"  value="16.00">16.00</td>
                      <td><input type="checkbox" name="time[]"  value="16.20">16.20</td>
                      <td><input type="checkbox" name="time[]"  value="16.40">16.40</td>
                    </tr>
                    <tr>
                      <th scope="row">10</th>
                      <td><input type="checkbox" name="time[]"  value="17.00">17.00</td>
                      <td><input type="checkbox" name="time[]"  value="17.20">17.20</td>
                      <td><input type="checkbox" name="time[]"  value="17.40">17.40</td>
                    </tr>

                  </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-custom">Submit</button>
            </div>
        </div>
        </form>
    </div>

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