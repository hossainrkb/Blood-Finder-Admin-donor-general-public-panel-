<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!--[if !mso]><!-- -->
       <link rel="stylesheet" href="{{asset('css/donor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" href="{{asset('css/donor/dataTables.bootstrap4.min.css')}}">
       


<style>

</style>

</head>
<body>
   
         
 @yield('content')

                   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
             <script src="{{asset('js/donor/bootstrap.min.js')}}"></script>
          <script src="{{asset('js/donor/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/donor/dataTables.bootstrap4.min.js')}}"></script>
   
  <script>
  $(document).ready( function () {
    $('#data-table').DataTable();
} );
  </script> 

   

</body>
@yield('script')
</html>
