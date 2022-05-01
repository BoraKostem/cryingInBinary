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
      <a class="navbar-brand" href="#">
        <img src="{{URL::asset('/image/bilkent_logo.png')}}" alt="Bilkent University Health Center" height="40" class="me-2"> Bilkent University Health Center  
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav ms-auto mb-2 mb-xl-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Appointments</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#">Health History</a></li>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="#">Settings</a>
          </li>
        </ul>
        
        <button class="btn btn-primary" type="submit" onclick="window.location='{{ url("auth/logout") }}'">Logout</button>
      </div>
    </div>
  </nav>