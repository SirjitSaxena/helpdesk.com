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
        
        <form action="{{ url('upload_timetable') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding:15px;">
                <label>Course</label>
                <select name="course" required>
                    <option hidden value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>

                    @endforeach
                    <option value="Generic Electives">Generic Electives</option>
                </select>
            </div>
            <div style="padding:15px;">
                <label>Semester</label>
                <select name="semester" required>
                    <option hidden value="">Select Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester }}">{{$semester }}</option>
                    @endforeach
                </select>
            </div>
            <div style="padding:15px;">
                <label>Timetable PDF</label>
                <input type="file" name="file" placeholder="upload time table" required>
            </div>
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
    @include('admin.script')

</body>

</html>
