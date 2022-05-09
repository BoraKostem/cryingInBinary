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

<style>
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
    background-color: #003366 !important;
    color: #fff;
    }

    .card-header, .card-footer{
      background: #ebebeb
    }
</style>

<div class="container">
    <div class="mt-5 mb-2">
        @include('roleMenus.menuComponents.newsCard',['userInfo'=> $userInfo])
    </div>
    





<div class="container">
        <!--Search doctor-->
    
        <div class="card mb-5 mt-2">
            <div class="card-body">
                <div class="card-header">Book Appointment</div>
                <div class="card-body">
                    <form action="{{url('/dashboard')}}" method="GET"> @csrf
                    <div class="row">
                            <div class="col-md-8">
                                    <input type="text" name="date" class="form-control" id="datepicker" placeholder="Select A Date">  
                            </div>                       <!--in url date=datepicker date-->
                            <div class="col-md-4">
                                <button class="btn btn-custom" type="submit">Find Doctors</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>      
    <!--display doctors-->
            <div class="card-body">
                <div class="card-header"> Doctors </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Expertise</th>
                                <th>Book</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($doctors as $doctor)
                            <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        {{$doctor->date}}
                                    </td>
                                    <td>
                                        {{App\Models\Staff::where('id','=', $doctor->user_id)->first()->name}}
                                    </td>
                                    <td>
                                        {{App\Models\Staff::where('id','=', $doctor->user_id)->first()->speciality}}
                                    </td>
                                    <td>
                                        <a href="{{route('create.appointment',[$doctor->user_id,$doctor->date])}}"><button class="btn btn-success">Book Appointment</button></a>
                                    </td>
                            </tr>
                            @empty
                            <td>No doctors available today</td>
                            @endforelse


                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

