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
@endsection


@section('content')

<div class="container">
    
    <div class="row">
        
        <div class="col mt-5">
            @include('roleMenus.menuComponents.newsCard',['userInfo'=> $userInfo])
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            @include('roleMenus.menuComponents.displayTestReq',['userInfo'=> $userInfo],['testList'=> $testList])
        </div>    
    </div>    
    
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection