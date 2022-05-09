@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script type="text/javascript"> //Search bar for staff table
   $(document).ready(function() {
    $('#history').DataTable();
} );
</script>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="mt-3">
            <div class="row mt-5">
                <div class="col">
                    <table id="history" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Patient ID</th>
                                <th>File Type</th>
                                <th>File Upload Time</th>
                                <th>Download PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientInfo as $patient)
                                @foreach ($historyInfo as $history)
                                    @if ($patient->bilkentID == $history->bilkentID)
                                        <tr>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $history->bilkentID }}</td>
                                            <td>{{ $history->type }}</td>
                                            <td>{{ $history->created_at }}</td>
                                            <td><a class="btn btn-primary" type="button" href="{{URL::asset("users/$history->bilkentID/$history->name")}}" download="{{ $patient->name }}_{{ $history->type }}">Download</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
