@extends('layouts.app',['userInfo' => $userInfo])

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

    <div class="mt-3">
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
    </div>
    <form action="{{ route('search') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mt-4">
            <div class="form-outline">
                <input type="search" name="searchInput" class="form-control" placeholder="Search" />
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <div class="form-group mt-3 overflow-auto" style="height: 42.2em">
        <table class="table table-bordered text-center align-middle" style="border-collapse: collapse;">
            <thead class="sticky-top">
                <tr>
                    <th>Name</th>
                    <th>bilkentID</th>
                    <th>File Type</th>
                    <th>Upload file</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($healths as $health)
                    <tr>
                        <form action="{{ route('send-pdf') }}" method="post" enctype="multipart/form-data">
                            <td>{{ $health->name }}</td>
                            <td>
                                <input class="text-center align-middle border-0" type="text" name="hiddenID" readonly
                                    value="{{ $health->bilkentID }}">
                            </td>
                            <td>
                                <select class="form-control text-center align-middle" type="text" style="height: 3em;" name="file" id="file">
                                    <option value="xray" selected="selected">Xray</option>
                                    <option value="mr">MR</option>
                                    <option value="blood_test">Blood Test</option>
                                </select>
                            </td>
                            @csrf
                            <td>
                                <div class="form-group mt-2">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02"
                                            name="healthhistory">
                                        <button class="btn btn-primary input-group-text" for="inputGroupFile02"
                                            type="submit" name="submit">Upload</button>
                                    </div>
                                </div>
                            </td>
                        </form>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
