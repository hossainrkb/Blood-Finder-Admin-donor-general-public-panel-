@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
   
    <div class="row mt-2">
        <div class="col-md-12 text-center">
           <div>
                <img src="{{ asset("img/mango_prople.png") }}" alt="" width="100px" >
           </div>
            <div>
                <button class="badge btn-xs btn-outline-primary">{{ $perameter }}</button>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
             @foreach ($total_request as $tr)
             @php
                 $tr->status = 1;
                 $tr->save();
             @endphp
        <div class="row"  >
            <div class="col-md-3"></div>
               <div class="col-md-2 text-right" style="border-right: 1px solid gray;">
              <p style=""> {{ $tr->date_time }}</p>
               @php
              // $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                //echo $dt->format('F j, Y, g:i a');    
               @endphp
              
           </div>
           <div class="col-md-5 text-left ">
              
         <div class="incoming_msg">
            <div class="received_msg">
                <div class="received_withd_msg">
                  <p style=""> {{ $tr->r_message }}</p>
                  
              </div>
            </div>
             
        </div>
        </div>
        </div>
        <br>
        @endforeach
    </div>
   
              </div>
              <div class="row">
                <div class="col-md-12">
                        <a class="badge btn-outline-danger"  href="{{ route("donor.request") }}" >back</a>
                </div>
              </div>
               </div>



      
      
               
             
            @endsection
             
