<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=100,initial-scale = 2.3,user-scalable=no">
    <!--[if !mso]><!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/donor.css')}}" />

     <style>
     div.rotate {  
}
     </style>
</head>
<body>
   
           <div class="container-fluid">          
            <div class="row">
              <div class="col-md-5"></div>
  <div class="col-md-2 rotate">
     @include('donor_panel.d_register.r_layouts.navside')
  </div>
  <div class="col-md-5" >
 
  </div>

 
</div>
<div class="row mt-2">
  <div class="col-md-12">
    @yield('content')
  </div>
</div>
           
           
           </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

@yield('script')
</body>
</html>
