@extends('layouts.app',['userInfo' => $userInfo])

@section('content')

    <form action="send-pdf" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">UPLOAD PDF</label><br>
        <input type="file" name="file">
        <button class="btn btn-danger" type="submit" name="submit">Submit</button>
    </form>
@endsection
