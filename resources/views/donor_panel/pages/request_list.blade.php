@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
  Hello {{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user()->name : '' }} Your Blood request bin !
             {{ Auth :: guard ('donor')->id()  }}
  
          @php 
           $Blood_request = App\Models\Blood_request::where('d_id', Auth :: guard ('donor')->id())->distinct()->orderBy('id','DESC')->get(['r_phone'])
          @endphp
        
    <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
             @foreach ($Blood_request as $br)
              @php 
              $dist_phone = App\Models\Blood_request::where('r_phone', $br['r_phone'])->orderBy('id','DESC')->first() 
              @endphp
           <a href="{{ route("mango.request_details",$br->r_phone ) }}">
              <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5>{{ $br->r_phone }}
                    @if($dist_phone->status==1)
                    <p class="badge text-success">Seen</p>
                    @else
                    <p class="badge text-danger">Unseen</p>
                    @endif
                    <span class="chat_date">{{ $dist_phone->date_time }}</span></h5>
                  <p>@if($dist_phone->status==0)
                     <span><b> {{ str_limit($dist_phone->r_message, 10) }}</b></span>
                      @else
                      <span>{{ str_limit($dist_phone->r_message, 10) }}</span>
                      @endif</p>
                </div>
              </div>
            </div>
           </a>
             @endforeach
          </div>
        </div>
        
      </div>
             
              </div>
               </div>



      
      
               
             
            @endsection
             
