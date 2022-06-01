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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
    label {
        display: inline-block;
        width: 200px;
    }

</style>

@include('admin.sidebar')

<body>
    <div class="container" align="center">
        @if (session()->has('message'))
            <div id="message">
                <div class="alert alert-success">{{ session()->get('message') }}</div>


            </div>
        @endif
        <span class="container">
            <h1 style="font-size: 30pt; text-align:center;">
                Edit Profile
            </h1>
        </span>
        <form action="{{ url('student_edited',$student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>

            <div style="padding:15px;">
                <label>Gender</label>
                <select name="gender">
                    @if (is_null($student->gender))
                    <option hidden value="">Select</option>
                @else
                    <option hidden value="{{ $student->gender }}">{{ $student->gender }}</option>
                @endif
                    
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div style="padding:15px;">
                <label>Blood Group</label>
                <select name="blood">

                    @if (is_null($student->blood_group))
                        <option hidden value="">Select</option>
                    @else
                        <option hidden value="{{ $student->blood_group }}">{{ $student->blood_group }}</option>
                    @endif
                    @foreach ($blood_groups as $blood)
                        <option value="{{ $blood }}">{{ $blood }}</option>
                    @endforeach
                </select>
            </div>

            <div style="padding:15px;">
                <label>Address</label>
                <input type="text" name="address" placeholder="Write Your Address" value="{{ $student->address }}">
            </div>
            <div style="padding:15px;">
                <label>Phone</label>
                <input type="number" name="phone" placeholder="Write Your Phone Number" value="{{ $student->phone }}">
            </div>
            <div style="padding:15px;">
                <label>Upload Student DP</label>
                <input type="file" name="dp">
            </div>
            </div>
            <div style="padding:15px; text-align:center;">
                <input type="submit" class="btn btn-success">
            </div>

        </form>
    </div>
    @include('admin.script')

</body>

</html>
