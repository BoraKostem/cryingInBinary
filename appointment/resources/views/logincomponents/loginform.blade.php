<style>
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
        background-color: #003366 !important;
        color: #fff;
    }

</style>

<div>
    <h4 class="allign-middle">Bilkent Health Center</h4>
        <form action="user" method="POST" >
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif

            
            @csrf
            <div class="form-group">
                <label>Bilkent ID</label>
                <input type="text" class="form-control mt-1 mb-1" name="bilkentID" placeholder="Bilkent ID">
                <span class="text-danger">@error('bilkentID'){{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control mt-1" name="password" placeholder="Password">
                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
            </div>
            <button type="submit" class="btn btn-custom btn-sm mt-3 mb-2 me-3">Login</button>
        </form>
</div>
