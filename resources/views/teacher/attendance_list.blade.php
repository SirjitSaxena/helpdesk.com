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
    @include('admin.css')
@include('admin.sidebar')
<div class="container" align="center">
    @if (session()->has('message'))
        <div id="message">
            <div class="alert alert-success">{{ session()->get('message') }}</div>


        </div>
    @endif
    <form action="{{ url('attendance_taken') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <h1 style=" font-size: 30px;" ><input type="hidden" name="course" value="{{$information->course}}"> Course: <span style="color:tomato;">{{$information->course}}</span></h1>
    <h1 style="font-size: 30px;padding:10px;"><input type="hidden" name="subject" value="{{$information->subject}}">Subject: <span style="color:tomato;">{{$information->subject}}</span></h1>
    <h1 style="font-size: 30px;padding:10px;"><input type="hidden" name="year" value="{{$information->year}}">Admission Year: <span style="color:tomato;">{{$information->year}}</span></h1>
    <h1 style="font-size: 30px;padding:10px;"><input type="hidden" name="semester" value="{{$information->semester}}">Semester: <span style="color:tomato;">{{$information->semester}}</span></h1>
    <h1 style="font-size: 30px;padding:10px;" ><input type="hidden"name="date" value="{{$information->date}}">Date: <span style="color:tomato;">{{$information->date}}</span></h1>
    <h1 style="font-size: 30px;padding:10px;" ><input type="hidden"name="periods" value="{{$information->periods}}">Number Of Periods: <span style="color:tomato;">{{$information->periods}}</span></h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Roll Number</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                $iterator = 0;
            @endphp
                @foreach ($students as $student)
                <tr>
                    
                    @php
                    $iterator++;
                    @endphp
                    <td>{{$iterator}}</td>
                    <td> <input type="hidden" name="roll_no{{$iterator}}" value="{{$student->college_roll_no}}">{{$student->college_roll_no}}</td>
                    <td><input type="hidden" name="name{{$iterator}}" value="{{$student->name}}">{{$student->name}}</td>
                    <td><select name="status{{$iterator}}" required>
                        <option value="{{$information->periods}}">Present</option>
                            <option value="0">Absent</option>
                    </select></td>
                    
                </tr>
                @endforeach
                
            </tbody>

        </table>
        <div style="padding:15px;"><input type="hidden" name="iterator" value="{{$iterator}}">
            
            <input type="submit" class="btn btn-success">
        </div>
    </div>
    </form>
  </body>
</html>