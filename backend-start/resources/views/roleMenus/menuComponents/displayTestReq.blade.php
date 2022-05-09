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

@php
    $uploadList = array(['bilkentID' => '', 'type' => '']);    
@endphp


<div class="container-fluid">
    <div class="mt-3">
        <div class="row mt-5">
            <div class="col">
                <table id="tests" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Requested Test</th>
                            <th>Add Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testList as $test)
                            <tr>
                                    <td>{{ App\Models\Staff::where('bilkentID',$test['doctorID'])->pluck('name')->first()}}</td>
                                    <td>{{ App\Models\Patient::where('bilkentID',$test['patientID'])->pluck('name')->first()  }}</td>
                                    <td>{{Str::ucfirst($test->requestedTest)}}</td>
                                    <td>
                                        <form action="{{ route('send-pdf1') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="testID" value="{{$test['id']}}">
                                            <input type="hidden" name="hiddenID" value="{{$test['patientID']}}">
                                            <input type="hidden" name="file" value="{{$test->requestedTest}}">
                                             <div class="input-group">
                                                <input type="file" class="form-control" name="results" placeholder="Upload a file">
                                                <input type="submit" class="btn-sm btn-custom" style="display:inline" value="Upload"/>
                                            </div>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Requested Test</th>
                            <th>Add Result</th>
                        </tr>
                    </tfoot>
                </table>
            </div>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

