<!DOCTYPE html>
<html lang="en">
<x-app-layout>
</x-app-layout>
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#message').delay(2000).fadeOut();
    });
</script>
@livewireStyles
<style type="text/css">
    label {
        display: inline-block;
        width: 200px;
    }

</style>

<body>


    <div class="container">
        <div style="color: black;">
            <h2 style="font-size: 25pt">
                <a href="{{ url('home') }}">Home</a>
            </h2>
        </div>


        <div class="container" align="center">
            @if (session()->has('message'))
                <div id="message">
                    <div class="alert alert-success">{{ session()->get('message') }}</div>


                </div>
            @endif
            <form action="{{ url('upload_query') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="padding:15px;">
                    <label  >Query Name</label>
                    <input type="text"   name="name" placeholder="Write query name" required>
                </div>
                <label  >Query</label>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">

                    <textarea name="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
                </div>
                <div style="padding:15px;">
                    <label for="sentto">Sending To</label>
                    <select name="sentto" required>
                        <option hidden value="">Select</option>

                        @foreach ($admins as $admin)
                            <option value="{{ $admin->name }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>


                </div>
                <div style="padding:15px;">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
        </div>

        
            <span class="container">
                <h1 style="font-size: 30pt; text-align:center;">
                    Your Recent Queries
                </h1>
            </span>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Query Name</th>
                            <th>Date</th>
                            <th>Query Message</th>
                            <th>Solved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queries as $query)
                            <tr>
                                <td scope="row">{{ $query->name }}</td>
                                <td>{{ $query->created_at }}</td>
                                <td>{{ $query->full_query }}</td>
                                <td>
                                    @livewire('query-status', ['model' => $query, 'field' => 'status'], key($query->id))
                                </td>
                                <td><a href="{{ route('deletequery', $query->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @livewireScripts
            @include('admin.script')

        </body>

</html>
