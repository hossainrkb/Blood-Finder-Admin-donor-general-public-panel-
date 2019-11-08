<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blOOd</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('js/dataTables/dataTables.bootstrap.css')}}" />



<style>
.sidebar-collapse .nav > li > a {
    background: darkcyan;
}
#wrapper{
    background: darkcyan
}
</style>

</head>
<body>
    <div id="wrapper">
            @include('backend.b_layouts.navtop')

        <!-- /. NAV TOP  -->
        @include('backend.b_layouts.navside')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                    @yield('content')
            </div>
        </div>
    </div>
    
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.canvasjs.min.js')}}"></script>
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
 <style>
 .canvasjs-chart-credit{
     visibility: hidden;
}
 </style>

</body>
</html>
