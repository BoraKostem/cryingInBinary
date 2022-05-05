@extends('layouts.app',['userInfo' => $userInfo])

@section('content')
    <form action="search" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mt-2">
            <div class="form-outline">
                <input type="search" name="searchInput" class="form-control" placeholder="Search" />
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <div class="form-group mt-2">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>bilkentID</th>
                    <th>Upload file</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($healths as $health)
                    <tr>
                        <form action="send-pdf" method="post" enctype="multipart/form-data">
                            <td>{{ $health->name }}</td>
                            <td><input class="text-center align-middle border-0" type="number" name="hiddenID" value="{{ $health->bilkentID }}"></td>
                            <td>
                                @csrf
                                <div class="form-group mt-2">
                                    <label>Upload health history</label>
                                    <input type="file" class="form-control" name="healthhistory"
                                        placeholder="Upload a file">
                                    {{-- <span class="text-danger">
                                        @error('healthhistory')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <button class="btn btn-block btn-primary mt-2" type="submit" name="submit">Submit</button>
                        </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
