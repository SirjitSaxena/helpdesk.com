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

<div class="container" align="center">
    @if (session()->has('message'))
        <div id="message">
            <div class="alert alert-success">{{ session()->get('message') }}</div>


        </div>
    @endif
    
    <span class="container">
        <h1 style="font-size: 30pt; text-align:center;">
            Subjects In {{$course->name}}.
        </h1>
    </span>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Added By</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td scope="row">{{$subject->name}}</td>
                    <td>{{$subject->semester}}</td>
                    <td>{{$subject->added_by}}</td>
                    <td><a href="{{route('deletesubject',$subject->id)}}" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{url('add_subject')}}" class="btn btn-primary">Add More Subjects</a>
    
  </body>
</html>