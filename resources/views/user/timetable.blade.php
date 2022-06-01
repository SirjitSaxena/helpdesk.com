<!doctype html>
<html lang="en">
  <head>
    <title>Timetable</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetable as $timetable)
                <tr>
                    <td scope="row">{{$timetable->course}}</td>
                    <td>{{$timetable->semester}}</td>
                    <td><a href="{{route('viewtimetable',$timetable->id)}}"  target = "_blank" class="btn btn-primary">View</a></td>
                    <td><a href="{{route('downloadtimetable',$timetable->id)}}" class="btn btn-primary">Download</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>
  </body>
</html>