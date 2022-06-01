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
        <form action="{{ url('upload_notice') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding:15px;">
                <label>Notice Name</label>
                <input type="text" name="name" placeholder="Write the Notice" required>
            </div>
            <div style="padding:15px;">
                <label>Notice Date</label>
                <input type="date" min="2020-01-01" max="{{ now()->toDateString('Y-m-d') }}"
                    name="date" required>
            </div>
            <div style="padding:15px;">
                <label>Notice PDF</label>
                <input type="file" name="file" required>
            </div>
            <div style="padding:15px;">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
    @include('admin.script')

</body>

</html>
