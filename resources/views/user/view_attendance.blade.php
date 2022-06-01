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
@include('teacher.sidebar')

<body>
    <div class="container" align="center">
        @if (session()->has('message'))
            <div id="message">
                <div class="alert alert-success">{{ session()->get('message') }}</div>


            </div>
        @endif
        <form action="{{ url('fetching_my_attendance') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <span class="container">
                <h1 style="font-size: 30pt; text-align:center;">
                    View Your Attendance
                </h1>
            </span>
            <div style="padding:15px;">
                <label>Course</label>
                <select name="course" id="course" required>
                    <option value="" hidden>Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="padding:15px;">
                <label>Subject Name</label>
                <select name="subject" id="subject" required>
                    <option value="" hidden>Select Subject</option>
                </select>

            </div>
            
            <div style="padding:15px;">
                <label>Semester</label>
                <select name="semester" required>
                    <option hidden value="">Select Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester }}">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>

        </form>
    </div>

    </tbody>
    </table>
    </div>
    @include('admin.script')


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#course').change(function() {
            let cid = jQuery(this).val();
            jQuery.ajax({
                url: '/getSubject',
                type: 'post',
                data: 'cid=' + cid + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#subject').html(result)
                }
            })
        })
    })
</script>

</html>