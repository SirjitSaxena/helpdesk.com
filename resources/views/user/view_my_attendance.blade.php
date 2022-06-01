<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <h1 style=" font-size: 30px;"> Course: <span style="color:tomato;">{{ $information->course }}</span></h1>
            <h1 style="font-size: 30px;padding:10px;">Subject: <span
                    style="color:tomato;">{{ $information->subject }}</span></h1>
            <h1 style="font-size: 30px;padding:10px;">Admission Year: <span
                    style="color:tomato;">{{ $information->year }}</span></h1>
            <h1 style="font-size: 30px;padding:10px;">Semester: <span
                    style="color:tomato;">{{ $information->semester }}</span></h1>


        </span>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Roll No</th>
                        <th>Attendance</th>
                        <th>Total Attendance</th>
                        <th>Attendance Percent</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $periods = [];
                        $total = [];
                    @endphp
                    @foreach ($attendance as $student)
                        @php
                            $periods[$student->student_name] = 0;
                            $total[$student->student_name] = 0;
                        @endphp
                    @endforeach

                    @foreach ($attendance as $student)
                        @php
                            $periods[$student->student_name] += $student->no_of_attendance;
                            $total[$student->student_name] += $student->no_of_total_attendance;
                        @endphp
                    @endforeach

                    <tr>@php
                        $name = 'Null';
                    @endphp
                        @foreach ($attendance as $student)
                            @if ($name == $student->student_name)
                            @else
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->roll_no }}</td>
                                <td>{{ $periods[$student->student_name] }}</td>
                                <td>{{ $total[$student->student_name] }}</td>
                                <td>
                                    @php
                                        $percent = round((100 * $periods[$student->student_name]) / $total[$student->student_name], 2);
                                    @endphp
                                    {{ $percent }}
                                </td>
                            @endif
                            @php
                                $name = $student->student_name;
                            @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="/view_attendance_student" class="btn btn-primary">Back</a>

</body>

</html>
