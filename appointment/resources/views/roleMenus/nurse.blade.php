@extends('layouts.app',['userInfo' => $userInfo])

@section('content')


<div class="container">
    <div class="row">
        <div class="col mt-5">
            @include('roleMenus.menuComponents.newsCard',['userInfo'=> $userInfo])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('roleMenus.menuComponents.displayTestReq',['userInfo'=> $userInfo],['testList'=> $testList])
        </div>    
    </div>    
    
</div>
    


@endsection