@extends('layouts.app',['userInfo' => $userInfo])

@section('content')


<div class="container">
    <div class="mt-5">
        @include('roleMenus.menuComponents.newsCard',['userInfo'=> $userInfo])
    </div>
    
</div>

@endsection