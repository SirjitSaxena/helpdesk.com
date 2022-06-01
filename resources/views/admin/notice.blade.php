<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#message').delay(2000).fadeOut();
    });
</script>
  </head>
  <body>
    <x-app-layout>
    </x-app-layout>
@include('admin.sidebar')
<div class="container" align="center">
    @if (session()->has('message'))
        <div id="message">
            <div class="alert alert-success">{{ session()->get('message') }}</div>


        </div>
    @endif
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notices as $notice)
                <tr>
                    <td scope="row">{{$notice->name}}</td>
                    <td>{{$notice->date}}</td>
                    <td><a href="{{route('downloadnotice',$notice->id)}}" class="btn btn-primary">Download</a></td>
                    <td><a href="{{route('deletenotice',$notice->id)}}" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </body>
</html>