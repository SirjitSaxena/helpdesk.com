<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Helpdesk</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#message').delay(2000).fadeOut();
    });
</script>
</head>
<body>
    @include('admin.css')

    <a class="btn btn-primary ml-lg-3" href="{{'check_teacher' }}">My Profile</a>
    @include('teacher.navbar')    
    @include('teacher.sidebar')
    <div class="container" align="center">
        @if (session()->has('message'))
            <div id="message">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
    
    
            </div>
        @endif
    
    <div class="container">
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="/notice_admin">Notices</a>
            </h2>
        </div>
    
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="/query_admin">Query</a>
            </h2>
        </div>
    
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="/timetable_admin">Time Table</a>
            </h2>
        </div>
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="/take_attendance">Take Attendance</a>
            </h2>
        </div>        
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="/view_attendance_teacher">View Attendance</a>
            </h2>
        </div>        
</body>
</html>
