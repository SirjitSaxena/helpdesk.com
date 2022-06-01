<!DOCTYPE html>
<html lang="en">
    <x-app-layout>
    </x-app-layout>
<head>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(function() {
        $('#message').delay(2000).fadeOut();
    });
</script>
    <title>Document</title>
</head>
<style>
    body {
        background: #67B26F;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #4ca2cd, #67B26F);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #4ca2cd, #67B26F);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        padding: 0;
        margin: 0;
        font-family: 'Lato', sans-serif;
        color: #000;
    }

    .student-profile .card {
        border-radius: 10px;
    }

    .student-profile .card .card-header .profile_img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 10px auto;
        border: 10px solid #ccc;
        border-radius: 50%;
    }

    .student-profile .card h3 {
        font-size: 20px;
        font-weight: 700;
    }

    .student-profile .card p {
        font-size: 16px;
        color: #000;
    }

    .student-profile .table th,
    .student-profile .table td {
        font-size: 14px;
        padding: 5px 10px;
        color: #000;
    }

</style>

<body>
    
    @php
        $check = 0;
    @endphp
    @foreach ($teacher as $user)
        <div class="student-profile py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent text-center">
                                <img class="profile_img" src="../dp/{{$user->profile_photo_path}}"
                               >
                                <h3>{{ $user->name }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">E-Mail</th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Department</th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->department }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Desingnation </th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->desingnation }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Qualification</th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->qualification }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Gender</th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Phone </th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Address </th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->address }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Blood Group</th>
                                        <td width="2%">:</td>
                                        <td>{{ $user->blood_group }}</td>
                                    </tr>
                                </table>
                        <a href="{{route('teacher.edit',['id'=>$user->id])}}"><button class="btn btn-primary">Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $check = 1;
        @endphp
    @endforeach
    <div class="container" align="center">
        @if (session()->has('message'))
                <div id="message">
                    <div class="alert alert-success">{{ session()->get('message') }}</div>
    
    
                </div>
            @endif</div>
    @if ($check == 0)
        <h1 style="padding-top: 15%; text-align:center;">No Teacher Found With This Email</h1>
            <a href="/home"><button style="align-content: center" type="button"
                    class="btn btn-danger">Home</button></a>
                    
        
        
    @endif
</body>

</html>
