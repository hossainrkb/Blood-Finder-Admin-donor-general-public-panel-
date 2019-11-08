<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=100,initial-scale = 2.3,user-scalable=no">
    <!--[if !mso]><!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/donor/bootstrap.min.css')}}" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/donor.css')}}" />

     <style>
     div.rotate {  
  -ms-transform: rotate(20deg); /* IE 9 */
  -webkit-transform: rotate(20deg); /* Safari 3-8 */
  transform: rotate(-55deg);
}
     </style>
</head>
<body>
  
           <div class="container-fluid">          
            <div class="row" style="">
              <div class="col-md-3"></div>
  <div class="col-md-2 rotate" style="margin-top: 220px;" >
     @include('donor_panel.d_login.l_layouts.navside')
  </div>
  <div class="col-md-4"style="margin-top: 140px;" >
 @yield('content')
  </div>

 
</div>
           
           
           </div>

        
                    
           
   

</body>
</html>
