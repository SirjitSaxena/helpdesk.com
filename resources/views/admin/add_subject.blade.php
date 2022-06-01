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
        <form action="{{ url('subject_added') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="padding:15px;">
                <label>Course</label>
                <select name="course" required>
                    <option hidden value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>

                    @endforeach
                  
                </select>
            </div>
            <div style="padding:15px;">
                <label>Semester</label>
                <select name="semester" required>
                    <option hidden value="">Select Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester }}">{{$semester }}</option>
                    @endforeach
                </select></div>
            <div style="padding:15px;">
                <label>Subject Name</label>
                <input type="text" name="name" placeholder="Write Subject Name" required>

            </div>
            
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>

        </form>
    </div>
    
    <span class="container">
        <h1 style="font-size: 30pt; text-align:center;">
            List Of Courses With Subjects
        </h1>
    </span>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Added By</th>
                    <th>Semester-Wise Subject</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td scope="row">{{ $course->name }}</td>
                        <td>{{ $course->added_by }}</td>

                        
                        <td><a href="{{route('viewsubject',$course->id)}}"  target = "_blank" class="btn btn-primary">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.script')


</body>

</html>
