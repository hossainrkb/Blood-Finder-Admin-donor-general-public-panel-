<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=100,initial-scale = 2.3,user-scalable=no">
    <!--[if !mso]><!-- -->
       <link rel="stylesheet" href="{{asset('css/donor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/donor/donor.css')}}" />
      <link rel="stylesheet" href="{{asset('css/donor/dataTables.bootstrap4.min.css')}}">
       

<style>
#overflowTest {
  width: 50%;
  height: 500px;
  overflow: auto;
  border: 1px solid #ccc;
}
</style>
<style>
.alert {
   height:55px;    
}
</style>
 <link rel="stylesheet" href="{{asset('css/donor/chat_list.css')}}" />


</head>
<body>
   
           <div class="container-fluid">
              
                <div class="row">
               
                    <div class=" col-lg-12 text-center btn-danger" style="position: fixed;overflow: hidden;">
                 <div class=" card-header ">
                        @include('donor_panel.d_layouts.navtop')
                 </div>
                </div>
            </div>    
            <div class="row" style="margin-top: 107px;">
  <div class="col-md-2 " >
     @include('donor_panel.d_layouts.navside')
  </div>
  <div class="col-md-10">
 @yield('content')
    @php
   $date = new DateTime;
$date->modify('-2 minutes');
$formatted_date = $date->format('Y-m-d H:i:s');
$donor_id =App\Models\Donor::where('id',Auth :: guard ('donor')->id() )->first() ;  
 $donor_id->donor_activity = now();
   $donor_id->save();
   @endphp
  </div>
</div>
           </div>
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
</html>
