<style>
.navbar-dark {
  background-color: #003366;
}

#navbar-top{
    z-index: 990;
}
</style>



<nav class="navbar navbar-expand-xl navbar-dark "  aria-label="navbar" id="navbar-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{URL::asset('/image/bilkent_logo.png')}}" alt="Bilkent University Health Center" height="40" class="me-2"> Bilkent University Health Center  
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav ms-auto mb-2 mb-xl-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          @if($userInfo['job'] != 'nurse' && $userInfo['job'] != 'secretary')
            <li class="nav-item">
              <a class="nav-link" href="{{route('my.booking')}}">Appointments</a>
            </li>
          @endif
          @if($userInfo['job'] == 'administrator')
          <li class="nav-item">
            <a class="nav-link" href="{{route('manageUser')}}">Manage User</a>
          </li>
          @endif
          
          @if($userInfo['job'] == 'administrator' || $userInfo['job'] == 'doctor' || $userInfo['job'] == 'nurse')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Health History</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <li><a class="dropdown-item" href="{{ route("healthHistory/{users?}") }}">View History</a></li></li>
              <li><a class="dropdown-item" href="{{route('upload') }}">Upload</a></li>
            </ul>
          </li>
          @else
            @if($userInfo['job'] != 'secretary')
              <li class="nav-item">
                  <a class="nav-link" href="{{ url("healthHistory/$userInfo->bilkentID") }}">Health History</a>
              </li>
            @endif
          @endif

          @if($userInfo['job'] != 'administrator')
              @if($userInfo['job'] == 'doctor')
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">Settings</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown02">
                  <li><a class="dropdown-item" href="{{route('appointment.create')}}">Create Shift</a></li>
                  <li><a class="dropdown-item" href="{{route('appointment.index')}}">Edit Shift</a></li>
                  <li><a class="dropdown-item" href="{{route('user.profile.edit')}}">Edit Profile</a></li>
                </ul>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link me-2" href="{{route('user.profile.edit')}}">Settings</a>
              </li>
              @endif
          @else
          <li class="nav-item">
            <a class="nav-link me-1" href="{{route('auth.admin')}}">Change Password</a>
          </li>
          @endif
        </ul>
        
        <button class="btn btn-primary ms-2" type="submit" onclick="window.location='{{ url("auth/logout") }}'">Logout</button>
      </div>
    </div>
  </nav>
