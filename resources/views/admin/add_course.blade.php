<!DOCTYPE html>
<html lang="en">
<x-app-layout>
</x-app-layout>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#message').delay(2000).fadeOut();
    });
</script>

<style type="text/css">
    label {
        display: inline-block;
        width: 200px;
    }

</style>
@include('admin.css')
@include('admin.sidebar')

<body>
    <div class="container" align="center">
        @if (session()->has('message'))
            <div id="message">
                <div class="alert alert-success">{{ session()->get('message') }}</div>


            </div>
        @endif
        <form action="{{ url('course_added') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="padding:15px;">
                <label>Course Name</label>
                <input type="text" name="name" placeholder="Write Course Name" required>
            </div>
            
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>

        </form>
    </div>
    
    <span class="container">
        <h1 style="font-size: 30pt; text-align:center;">
          List Of Courses
        </h1>
    </span>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Added By</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td scope="row">{{ $course->name }}</td>
                        <td>{{ $course->added_by }}</td>
           
                        
                        <td><a href="{{ route('deletecourse', $course->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.script')

</body>

</html>
