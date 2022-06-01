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
            <h1 style="font-size: 30px;padding:10px;">Name: <span
                style="color:tomato;">{{ Auth::user()->name }}</span></h1>
                
            <h1 style=" font-size: 30px;"> Course: <span style="color:tomato;">{{ $information->course }}</span></h1>
            <h1 style="font-size: 30px;padding:10px;">Subject: <span
                    style="color:tomato;">{{ $information->subject }}</span></h1>
            <h1 style="font-size: 30px;padding:10px;">Semester: <span
                    style="color:tomato;">{{ $information->semester }}</span></h1>
                    
                    


        </span>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>                        
                        <th>Attendance</th>
                        <th>Total Attendance</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_present=0;
                     $total_attendance=0;   
                    @endphp
                    @foreach($attendance as $item)
                    <tr>
                                <td>{{ $item->attendance_date }}</td>
                                <td>{{ $item->no_of_attendance }}</td>
                                <td>{{$item->no_of_total_attendance  }}</td>
                                @php
                                $total_attendance+=$item->no_of_total_attendance;
                                $total_present+=$item->no_of_attendance;
                                @endphp
                    </tr>
                    @endforeach
                    <tr><td><b style="font-size:20px"> Total</b></td>
                    <td><b>{{$total_present}}</b></td>
                <td><b>{{$total_attendance}}</b></td></tr>
                </tbody>
            </table>
        </div>
        @php
            $percent=round(100*$total_present/$total_attendance,2)
        @endphp
        <h1 style="font-size: 30px;padding:10px;">Percent: <span
            style="color:tomato;">{{ $percent }}%</span></h1>
        <a href="/view_my_attendance" class="btn btn-primary">Back</a>

</body>

</html>
