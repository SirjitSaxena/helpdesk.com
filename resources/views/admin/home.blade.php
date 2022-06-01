
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
   <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
   <script type="text/javascript">
       $(function() {
           $('#message').delay(2000).fadeOut();
       });
   </script>
  </head>
  <body>
    @include('admin.navbar')    
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container" align="center">
        @if (session()->has('message'))
            <div id="message">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
    
    
            </div>
        @endif
    
        <!-- partial -->
@include('admin.body')
    <!-- container-scroller -->
    <!-- plugins:js -->
  
    
  </body>
</html>