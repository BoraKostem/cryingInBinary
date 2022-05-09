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
    $('#tests').DataTable();
} );
</script>

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
   background-color: #e1eef1 ; // Table stripped background
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
        <div class="row mt-5">
            <div class="col">
                <table id="tests" class="table table-striped" style="width:100%">
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
                        @foreach ($testList as $staff)
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


        </div>
    </div>
</div>
    




@endsection