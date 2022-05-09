@extends('layouts.app',['userInfo' => $userInfo])

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

<div class="container-fluid">   
    <div class="mt-3">
        @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif

        @error('requestedTest')
        <div class="alert alert-danger">
        {{ $message }}
        </div> 
        @enderror

        @error('patientID')
        <div class="alert alert-danger">
        {{ $message }}
        </div> 
        @enderror
    </div>
    <div class="mt-2">
        @include('roleMenus.roleSpecialPages.requestTest',['userInfo'=> $userInfo],['patList'=> $patList])
    </div>
    <div class="row">
        <div class="col">
            
        </div>
    </div>
    <div class="row">
        <div class="col mt-4">
            @include('roleMenus.menuComponents.newsCard',['userInfo'=> $userInfo],['patList'=> $patList])
        </div>
    </div>
    
</div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection