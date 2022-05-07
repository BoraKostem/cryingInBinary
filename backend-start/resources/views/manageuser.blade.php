@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script type="text/javascript"> //Search bar for staff table
   $(document).ready(function() {
    $('#staff').DataTable();
} );
</script>

<script type="text/javascript"> //Search bar for patients table
    $(document).ready(function() {
     $('#patient').DataTable();
 } );
 </script>

@endsection

@section('content')

<style>
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
    background-color: #003366 !important;
    color: #fff;
    }

    .table-striped>tbody>tr:nth-child(odd)>td, 
    .table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #ebf3f6 ; // Table stripped background
 }


</style>

<!--  To change color of the page buttons

 .pagination .page-item.active .page-link { 
     background-color: #003366; }

div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link:focus {
background-color: #003366;
}

.pagination .page-item.active .page-link:hover {
background-color: #003366;
}

-->

<div class="container-fluid">
    <div class="mt-5">
        <div class="row" style="border-bottom: 1px solid #003366">
            <div class="col-md-6 mb-1">
                <a href="{{route('auth.register.staff')}}" class="btn btn-custom">Create New Staff</a>
            </div>
            <div class="col-md-6 mb-1">
                <a href="{{route('auth.register')}}" class="btn btn-custom">Create New Patient</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <table id="staff" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Bilkent ID</th>
                            <th>Name</th>
                            <th>Proffession</th>
                            <th>Location</th>
                            <th>Delete Staff</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffList as $staff)
                            <tr>
                                <td>{{$staff['bilkentID']}}</td>
                                <td>{{Str::ucfirst($staff->name)}}</td>
                                <td>{{Str::ucfirst($staff->job)}}</td>
                                <td>
                                @if($staff->location == 'main')
                                    Main Campus
                                @else
                                    East Campus
                                @endif
                                </td>
                                <td>
                                    <form action="delStaff" onsubmit="return confirm('Are you sure to delete this user?');" method="POST">
                                        @csrf
                                        <input type="hidden" name="bilkentID" value="{{$staff['bilkentID']}}"/>
                                        <input type="submit" class="btn-sm btn-custom" id="delete-user" value="Delete Staff"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Bilkent ID</th>
                            <th>Name</th>
                            <th>Proffession</th>
                            <th>Location</th>
                            <th>Delete Staff</th>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <div class="col-md-6">
                <table id="patient" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Bilkent ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Delete Patient</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{$patient['bilkentID']}}</td>
                                <td>{{Str::ucfirst($patient->name)}}</td>
                                <td>{{$patient->gender}}</td>
                                <td>{{\Carbon\Carbon::parse($patient['birthday'])->age }}</td>
                                <td>
                                    <form action="delPatient" onsubmit="return confirm('Are you sure to delete this user?');" method="POST">
                                        @csrf
                                        <input type="hidden" name="bilkentID" value="{{$patient['bilkentID']}}"/>
                                        <input type="submit" class="btn-sm btn-custom" id="delete-user" value="Delete Patient"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Bilkent ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Delete Patient</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
    




@endsection