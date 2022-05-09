<style>
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
    background-color: #003366 !important;
    color: #fff;
    }

    .card-header, .card-footer{
      background: #ebebeb
    }
</style>





<!-- Doctor Request Test-->
<div class="modal fade" id="reqTest" tabindex="-1" aria-labelledby="editTestLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTestLabel">Request Test</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="addTest" method="POST" >
            @csrf
        <div class="modal-body">
                <input type="hidden" name="doctorID" value="{{$userInfo['bilkentID']}}"/>

                <div class="form-group">
                    <label>Select Patient:</label>
                    <select class="form-control mb-2" name="patientID">
                     <option value="" selected disabled>Please Select A Patient</option>
                     @foreach($patList as $patient)

                        <option value="{{ $patient->bilkentID }}">{{ $patient->name}}</option>

                     @endforeach
                   </select>
                  <span class="text-danger">@error('patientID'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label>Test Type</label>
                    <input type="text" class="form-control" name="requestedTest" placeholder="Please enter the test name to request.">
                    <span class="text-danger">@error('requestedTest'){{ $message }} @enderror</span>

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
