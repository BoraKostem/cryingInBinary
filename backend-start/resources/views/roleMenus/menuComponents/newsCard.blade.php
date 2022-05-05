<style>
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
    background-color: #003366 !important;
    color: #fff;
    }
</style>





<div class="container">   
             @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Health Center News</h5>
                </div>
                <div class="card-body">
                    @php
                     $healthText = DB::table('data')->where('dataType', 'healthNews')->value('value');
                     $lastEdited = DB::table('data')->where('dataType', 'healthNews')->value('lastEdited');         
                    @endphp
                  <p class="lead" style="white-space: pre-line"> {{$healthText}} </p>
                </div>
                <div class="card-footer text-muted">
                    @if($userInfo['job'] != 'administrator')
                    {{$lastEdited}}
                    @else
                    <a class="pt-3" href="#" data-bs-toggle="modal" data-bs-target="#editNews" style="display:inline">Edit News</a>
                    @endif
                </div>
              </div>
</div> 


<!-- Admin only News Editing Menu -->
<div class="modal fade" id="editNews" tabindex="-1" aria-labelledby="editNewsLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editNewsLabel">Edit Health News</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="chngnws" method="POST" >
            @csrf
        <div class="modal-body">
            
            <div class="form-group">
                <label for="messageText" class="form-control-label">Change News:</label>
                <textarea class="form-control" name="messageText"></textarea>
                <span class="text-danger">@error('messageText'){{ $message }} @enderror</span>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-custom">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
