@extends('layouts.app',['userInfo' => $userInfo])

@section('content')


<div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
    <h4 >{{$userInfo['name']}}</h4>
    <div class="row mt-4" >
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Bilkent Id</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['bilkentID']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Name</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['name']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Gender</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['gender']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Birthday</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['birthday']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Email</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['email']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Phone</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <p>{{$userInfo['phone']}}</p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Blood Type</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            @if(isset($userInfo['blood_type']))
                <p>{{$userInfo['blood_type']}}</p>
            @else
                <p>Blood Type Info Missing</p>
            @endif
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Height</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            @if(isset($userInfo['height']))
                <p>{{$userInfo['height']}} meter</p> 
            @else
                <p>Height Info Missing</p>
            @endif
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            <label>Weight</label>
        </div>
        <div class="col-md-5" style="border-bottom:1px solid #aeaeae;">
            @if(isset($userInfo['weight']))
                <p>{{$userInfo['weight']}} kg</p>
            @else
                <p>Weight Info Missing</p>
            @endif
        </div>
    </div>
</div>


<div class="mt-5">
    <div class="row">
        <h5>Appointment Come Here</h5>
    </div>

</div>

@endsection