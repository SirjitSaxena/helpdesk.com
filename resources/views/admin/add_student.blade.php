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
        <form action="{{ url('student_added') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding:15px;">
                <label>Roll Number<span style="color: red"> *</span></label>
                <input type="number" name="roll_no" placeholder="College Roll Number" required>
            </div>
            <div style="padding:15px;">
                <label>Student Name<span style="color: red"> *</span></label>
                <input type="text" name="name" placeholder="Write The Name" required>
            </div>
            
            <div style="padding:15px;">
                <label>Year Of Admission<span style="color: red"> *</span></label>
                <select name="admission_year" required>
                    <option hidden value="">Select</option>

                    @for ($year = 2020; $year <= date('Y'); $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div style="padding:15px;">
                <label>Course<span style="color: red"> *</span></label>
                <select name="course" required>
                    <option hidden value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="padding:15px;">
                <label>Email<span style="color: red"> *</span></label>
                <input type="text" name="email" placeholder="Write Student's E-Mail" required>
            </div>
            
            
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>

        </form>
    </div>
    @include('admin.script')

</body>

</html>
