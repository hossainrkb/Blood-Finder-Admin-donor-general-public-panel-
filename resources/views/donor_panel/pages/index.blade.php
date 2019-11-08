@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
  @php
   $donor_id =App\Models\Donor::where('id',Auth :: guard ('donor')->id() )->first() ;   
  @endphp
    <div class="alert alert-info mt-2">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul style="color: black">
           Hello <b>{{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user()->name : '' }}</b> Welcome back !
                 @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $donor_id->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
         </ul>
       
    </div>
     @php  
     $bg =App\Models\Blood_group::where('id',Auth :: guard ('donor')->user()->blood_group_id )->first() ;
     
     $donor_log =App\Models\Blood_donate_log::orderBy('id', 'desc')->where('d_id', Auth :: guard ('donor')->id() )->get();
  
     @endphp
         
     <div class="row">
        <div class="col-md-1"></div>
             <div class="col-md-3">
     <div class="card bg-danger">
    <div class="card-body text-center">
      <div style="color:blanchedalmond;font-family: URW Chancery L, cursive">
          <p style="font-size: 20px"><i><b>Blood group</b></i></p>
      <p class="card-text">{{ $bg->bg_name }}</p>
      </div>
    </div>
  </div>
             </div>
             
             <div class="col-md-3">
     <div class="card bg-info">
    <div class="card-body text-center">
      <div style="color:blanchedalmond;font-family: URW Chancery L, cursive">
          <p style="font-size: 20px"><i><b>Donate blood</b></i></p>
            <p class="card-text">{{ count($donor_log) }} time</p>
           
             @php 
        //  $arr_ip = geoip()->getLocation('45.125.223.50');
        // echo $arr_ip;
         @endphp
          
      </div>
    </div>
  </div>
             </div>
             <div class="col-md-3">
     <div class="card" style="background: grey">
    <div class="card-body text-center">
      <div style="color:blanchedalmond;font-family: URW Chancery L, cursive">
          <p style="font-size: 20px"><i><b>Type</b></i></p>
            <p class="card-text">
                 @if(count($donor_log)>= 5)
               <span class="badge" style="color: cyan   "> <i class="fas fa-trophy fa-2x"></i> Platinum</span>
               @elseif(count($donor_log)>= 3)
               <span class="badge"  style="color: #FFDF00   "> <i class="fas fa-trophy fa-2x"></i> Gold</span>
               @elseif(count($donor_log)>= 2)
               <span class="badge"  style="color: #D3D3D3   "> <i class="fas fa-trophy fa-2x"></i> Silver</span>
               @else
               <span class="badge" style="color: red   "> <i class="fas fa-trophy fa-2x"></i> General</span>
               @endif 
            </p>
      </div>
    </div>
  </div>
             </div>
             <div class="col-md-1"></div>
          </div>
        
   
             
              </div>
               </div>



      
      
               
             
            @endsection
			 
			
			  
