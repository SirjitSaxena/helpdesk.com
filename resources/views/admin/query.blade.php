<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @livewireStyles
  </head>
  <x-app-layout>
</x-app-layout>
  <body>

    <nav>
        <ul class="nav">
          <div class="container">      
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('home')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title" style="font-size: 50px;">Home</span>
            </a>
          </li>
          </div></ul></nav>    
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Query Name</th>
                    <th>Date</th>
                    <th>Query Message</th>
                    <th>Solved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $query)
                <tr>
                    <td scope="row">{{$query->name}}</td>
                    <td>{{$query->created_at}}</td>
                    <td>{{$query->full_query}}</td>
                    <td>
                      @livewire('query-status', ['model' => $query, 'field' => 'status'], key($query->id))
                  </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @livewireScripts
  </body>
</html>