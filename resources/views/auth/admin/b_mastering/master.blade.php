<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blOOd</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />

  
    <link rel="stylesheet" href="{{asset('js/dataTables/dataTables.bootstrap.css')}}" />





</head>
<body>
    @yield('content')
    <script src="{{asset('js/all.js')}}"></script>
    <script src="{{asset('js/jquery-1.10.2.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables/dataTables.bootstrap.js')}}"></script>


    <script>
        $(document).ready(function () {
            $('#d_table').dataTable();
        });
</script>
 <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
