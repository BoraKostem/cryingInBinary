@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-10 mt-4">
          @if(Session::get('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
        @endif

        @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
            <div class="card">
                <div class="card-header">Your appointments ({{$appointments->count()}})</div>

                <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          @if($userInfo->job == 'doctor')
                          <th scope="col">Patient</th>
                          @else
                          <th scope="col">Doctor</th>
                          @endif
                          <th scope="col">Time</th>
                          <th scope="col">Date for</th>
                          <th scope="col">Created date</th>
                          <th scope="col">Status</th>
                          @if($userInfo->job == 'doctor')
                            <th scope="col">Accept Patient</th>
                          @endif
                          @if($userInfo->job == 'bilkenter')
                            <th scope="col">Cancel</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($appointments as $key=>$appointment)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          @if($userInfo->job == 'doctor')
                          <td>{{App\Models\Patient::where('id','=', $appointment->user_id)->first()->name}}</td>
                          @else
                          <td>{{App\Models\Staff::where('id','=', $appointment->doctor_id)->first()->name}}</td>
                          @endif
                          <td>{{$appointment->time}}</td>
                          <td>{{$appointment->date}}</td>
                          <td>{{$appointment->created_at}}</td>

                          <td>
                              @if($appointment->status=="created")
                              <button class="btn btn-primary">Not visited</button>
                              @else 
                              <button class="btn btn-success"> Visited</button>
                              @endif
                          </td>
                          @if($userInfo->job == 'doctor')
                            <td>
                              <form action="{{route('accept')}}" onsubmit="return confirm('Accept this Patient?');" method="post">
                                @csrf
                                <input type="hidden" value="{{$appointment->id}}" name="appId">
                                @if($appointment->status=="created")
                                <button class="btn btn-primary" type="submit" >Accept</button>
                                @else
                                <button class="btn btn-secondary" type="submit" disabled>Accepted</button>
                                @endif
                              </form>
                            </td>
                          @endif
                          @if($userInfo->job == 'bilkenter')
                          <td>
                            <form action="{{route('appointment.cancel')}}"  onsubmit="return confirm('Do you want to cancel this appointment?');" method="post">
                              @csrf
                              <input type="hidden" name="appointmentTime" value="{{$appointment->time}}">
                              <input type="hidden" name="appointmentTimeID" value="{{$appointment->appointment_id}}">
                              <input type="hidden" name="appointmentID" value="{{$appointment->id}}">
                              <button class="btn btn-danger" type="submit">Cancel</button>
                            </form>
                          </td>

                          @endif
                        </tr>
                        @empty
                        <td>No appointments</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        @if($userInfo->job == 'doctor')
                        <td>-</td>
                        @endif
                        @if($userInfo->job == 'bilkenter')
                        <td>-</td>
                        @endif
                        @endforelse
                       
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
