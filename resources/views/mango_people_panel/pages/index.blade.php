@extends('mango_people_panel.mp_mastering.master')

@section ('content')
@php
    $s_div = "";
$s_dis = "";
$s_upa = "";
$s_uni = "";
$s_bg = "";
@endphp
 <div class="">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">

            @foreach ($sliders as $slider)
             <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index}}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
            @endforeach

          </ol>
          <div class="carousel-inner">

            @foreach ($sliders as $slider)
              <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ asset('img/sliders/'.$slider->image) }}" alt="{{ $slider->title }}" style="height: 300px;" />

                <div class="carousel-caption d-none d-md-block">
               
                  
               

                </div>
            </div>
            @endforeach
            

          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
<div class="container">
  <div class="row">
<div class="col-md-12 text-center">
 
   <div align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
      <div style="line-height: 35px">
          <span style="color: red;">BLOOD</span> Finder
      </div>
  </div>
     @php
           @include('backend.partials.message')
     @endphp     
</div>
</div>

  @php
    $divs = Input::get('div');
    $diss = Input::get('dis');
    $upas = Input::get('upa');
    $unis = Input::get('uni');
    $bgs = Input::get('bg');
    @endphp
  @if(is_numeric($diss) and is_numeric($divs) and is_numeric($upas) and is_numeric($unis) and is_numeric($bgs))
    @php $donor = App\Models\Donor::Where('d_division', $divs)
    ->Where('d_district', $diss)
    ->Where('d_upazila', $upas)
    ->Where('d_union', $unis)
    ->Where('blood_group_id', $bgs)
    ->Where('status', 1)
    ->get(); 
  
    @endphp
@if(count($donor)==0 )
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  Sorry,No donor found
                </div>
              </div>
              
@else
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
              
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              <table class="table table-condensed table-bordered table-hover text-center" id="data-table">
              <thead>
                  <tr class="btn-outline-danger">
                   
                      <td><b>#SL</b></td>
                      <td><b>Name</b></td>
                      <td><b>Phone</b></td>
                      <td><b>Email</b></td>
                      <td><b>Status</b></td>
                      <td><b>Action</b></td>
                  </tr>
              </thead>
              <tbody>
                @php
                   
                @endphp
                 @foreach ($donor as $dnr)
                 @php
                   //  dd("fdfdf")
                 @endphp
                      @php  $bg = App\Models\Blood_group::where('id', $dnr->blood_group_id)->first() @endphp
                      @php $donate = App\Models\Blood_donate::where('d_id', $dnr->id)->first() @endphp
                  @php
                  $current_date = date('Y-m-d');
                  @endphp
                  @if($donate)
                   @php
                        $given_date= $donate->dod;
                  $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                   @endphp
                    @if($d_diff>=90)
                   <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                    @else
                     <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                 @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
          </table>
           </div>
         </div>
@endif
 @elseif( is_numeric($bgs) and is_numeric($divs) and is_numeric($diss) and is_numeric($upas))
    @php $donor_bg_div_dis_upa = App\Models\Donor::Where('d_division', $divs)
    ->Where('blood_group_id', $bgs)
     ->Where('d_district', $diss)
     ->Where('d_upazila', $upas)
    ->Where('status', 1)
    ->get(); 
  
    @endphp



@if(count($donor_bg_div_dis_upa)==0 )
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  Sorry,No donor found
                </div>
              </div>
              
@else
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
              
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              <table class="table table-condensed table-bordered table-hover text-center" id="data-table">
              <thead>
                  <tr class="btn-outline-danger">
                   
                      <td><b>#SL</b></td>
                      <td><b>Name</b></td>
                      <td><b>Phone</b></td>
                      <td><b>Email</b></td>
                      <td><b>Status</b></td>
                      <td><b>Action</b></td>
                  </tr>
              </thead>
              <tbody>
                @php
                   
                @endphp
                 @foreach ($donor_bg_div_dis_upa as $dnr)
                 @php
                   //  dd("fdfdf")
                 @endphp
                      @php  $bg = App\Models\Blood_group::where('id', $dnr->blood_group_id)->first() @endphp
                      @php $donate = App\Models\Blood_donate::where('d_id', $dnr->id)->first() @endphp
                  @php
                  $current_date = date('Y-m-d');
                  @endphp
                  @if($donate)
                   @php
                        $given_date= $donate->dod;
                  $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                   @endphp
                    @if($d_diff>=90)
                   <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                    @else
                     <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                 @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
          </table>
           </div>
         </div>
@endif
  @elseif( is_numeric($bgs) and is_numeric($divs) and is_numeric($diss))
    @php $donor_bg_div_dis = App\Models\Donor::Where('d_division', $divs)
    ->Where('blood_group_id', $bgs)
     ->Where('d_district', $diss)
    ->Where('status', 1)
    ->get(); 
  
    @endphp



@if(count($donor_bg_div_dis)==0 )
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  Sorry,No donor found
                </div>
              </div>
              
@else
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
              
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              <table class="table table-condensed table-bordered table-hover text-center" id="data-table">
              <thead>
                  <tr class="btn-outline-danger">
                   
                      <td><b>#SL</b></td>
                      <td><b>Name</b></td>
                      <td><b>Phone</b></td>
                      <td><b>Email</b></td>
                      <td><b>Status</b></td>
                      <td><b>Action</b></td>
                  </tr>
              </thead>
              <tbody>
                @php
                   
                @endphp
                 @foreach ($donor_bg_div_dis as $dnr)
                 @php
                   //  dd("fdfdf")
                 @endphp
                      @php  $bg = App\Models\Blood_group::where('id', $dnr->blood_group_id)->first() @endphp
                      @php $donate = App\Models\Blood_donate::where('d_id', $dnr->id)->first() @endphp
                  @php
                  $current_date = date('Y-m-d');
                  @endphp
                  @if($donate)
                   @php
                        $given_date= $donate->dod;
                  $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                   @endphp
                    @if($d_diff>=90)
                   <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                    @else
                     <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                 @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
          </table>
           </div>
         </div>
@endif
    @elseif( is_numeric($bgs) and is_numeric($divs))
    @php $donor_bg_div = App\Models\Donor::Where('d_division', $divs)
    ->Where('blood_group_id', $bgs)
    ->Where('status', 1)
    ->get(); 
  
    @endphp



@if(count($donor_bg_div)==0 )
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  Sorry,No donor found
                </div>
              </div>
              
@else
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
              
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              <table class="table table-condensed table-bordered table-hover text-center" id="data-table">
              <thead>
                  <tr class="btn-outline-danger">
                   
                      <td><b>#SL</b></td>
                      <td><b>Name</b></td>
                      <td><b>Phone</b></td>
                      <td><b>Email</b></td>
                      <td><b>Status</b></td>
                      <td><b>Action</b></td>
                  </tr>
              </thead>
              <tbody>
                @php
                   
                @endphp
                 @foreach ($donor_bg_div as $dnr)
                 @php
                   //  dd("fdfdf")
                 @endphp
                      @php  $bg = App\Models\Blood_group::where('id', $dnr->blood_group_id)->first() @endphp
                      @php $donate = App\Models\Blood_donate::where('d_id', $dnr->id)->first() @endphp
                  @php
                  $current_date = date('Y-m-d');
                  @endphp
                  @if($donate)
                   @php
                        $given_date= $donate->dod;
                  $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                   @endphp
                    @if($d_diff>=90)
                   <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                    @else
                     <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                 @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
          </table>
           </div>
         </div>
@endif
    
  
     
    @elseif( is_numeric($bgs))
    @php $donor_bg = App\Models\Donor::Where('blood_group_id', $bgs)
    ->Where('status', 1)
    ->get(); 
  
    @endphp



@if(count($donor_bg)==0 )
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  Sorry,No donor found
                </div>
              </div>
              
@else
 @php 
       $s_bg = App\Models\Blood_group::where('id', $bgs)->first(); 
       @endphp
      @if($divs)
        @php 
        $s_div = App\Models\Division::where('div_id', $divs)->first();
       @endphp
      @endif
      @if($diss)
        @php 
        $s_dis = App\Models\District::where('dis_id', $diss)->first();
       @endphp
      @endif
      @if($upas)
        @php 
         $s_upa = App\Models\Upazila::where('upa_id', $upas)->first();
       @endphp
      @endif
      @if($unis)
        @php 
       $s_uni = App\Models\Union::where('uni_id', $unis)->first();
       @endphp
      @endif
 
         <div class="row">
           <div class="col-lg-12">
              <div class="text-center"><b>SEARCHED FOR:</b>
              
                @if($s_div)
                <span class="badge btn-outline-info"> {{ $s_div->div_name_en }}</span>|
                @endif
                @if($s_dis)
                 <span class="badge btn-outline-info">{{ $s_dis->dis_name_en }}</span>|
                @endif
                @if($s_upa)
                 <span class="badge btn-outline-info">{{ $s_upa->uni_name_bn }}</span>|
                @endif
                @if($s_uni)
                 <span class="badge btn-outline-info">{{ $s_uni->uni_name_bn }}</span>|
                @endif
                <span class="badge btn-outline-info">{{ $s_bg->bg_name }}</span>
                <a href="{{ route("mango_people") }}" class="badge btn-outline-danger float-right">Search another</a>
              </div>
              <table class="table table-condensed table-bordered table-hover text-center" id="data-table">
              <thead>
                  <tr class="btn-outline-danger">
                   
                      <td><b>#SL</b></td>
                      <td><b>Name</b></td>
                      <td><b>Phone</b></td>
                      <td><b>Email</b></td>
                      <td><b>Status</b></td>
                      <td><b>Action</b></td>
                  </tr>
              </thead>
              <tbody>
                @php
                   
                @endphp
                 @foreach ($donor_bg as $dnr)
                 @php
                   //  dd("fdfdf")
                 @endphp
                      @php  $bg = App\Models\Blood_group::where('id', $dnr->blood_group_id)->first() @endphp
                      @php $donate = App\Models\Blood_donate::where('d_id', $dnr->id)->first() @endphp
                  @php
                  $current_date = date('Y-m-d');
                  @endphp
                  @if($donate)
                   @php
                        $given_date= $donate->dod;
                  $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                   @endphp
                    @if($d_diff>=90)
                   <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                    @else
                     <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $dnr->name }}</td>
                      <td>{{ $dnr->phone }}</td>
                      <td>{{ $dnr->email }}</td>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                      <td>  @if ($formatted_date < $dnr->donor_activity)
                        <span class="badge btn-success">Online</span>                              
                            @else
                            <span class="badge btn-danger">Offline</span>
                        @endif
                        </td>
                      <td><a href="#sendreq{{  $dnr->id  }}" data-toggle="modal" class="badge btn-info">Send Message</a>
                         <!-- [Send message] -->
              <div class="modal fade" id="sendreq{{   $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Send Request for blood </b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('send_req' )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                 @php
                                       $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                 @endphp
                                 {{ $dt->format('F j, Y, g:i a') }}
                                 <input type="hidden" name="request_date" value="{{  $dt->format('F j, Y, g:i a') }}">
                                 <input type="hidden" name="donor_id" value="{{  $dnr->id }}">
                                   <td style="font-size: 15px;text-align: right"><b>Your Mobile Number: </b></td>
                                   <td><input minlength="11"  maxlength="11" required  type="text" class="form-control" name="cell"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Message: </b></td>
                                   <td><textarea class="form-control" name="mess" id="" cols="" rows="5"></textarea></td>
                                </tr>
                                  
                                <tr>
                                   
                                    <td colspan="2">
                                        <input  type="submit" value="Send Request" class="btn btn-outline-danger btn-xs float-right">
                                    </td>
                                </tr>
                           </table>
                  
                  </form>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
                      </td>
                                                        
                    </tr> 
                  @endif
                 @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
          </table>
           </div>
         </div>
@endif
     

    @else
    <div class="row">
      <div class="col-md-12 text-center ">
        <span class="badge btn-outline-info">
 Pursuing by selecting all elements or just each of the element, thank you!
        </span>
      </div>
    </div>
  <form action="" method="get">
    <table class="table">
      <tr>
        <td>
          <select style="width: 170px" class="form-control "  name="div" id="division_id"   >
  <option value="">Division</option>
  @foreach ($Division as $div)
  <option value="{{$div->div_id}}">{{$div->div_name_en}}</option>
  @endforeach
  </select> 
        </td>
        <td>
<select style="width: 170px"  class="form-control" name="dis"  id="district_id"  >
<option value="">District</option>
</select>
        </td>
        <td>
          <select style="width: 170px"  class="form-control" name="upa"   id="upazila_id"  >
  <option value="">Upazila</option>    
</select>
        </td>
        <td>
            <select style="width: 170px"  class="form-control" name="uni"  id="union_id" >
  <option value="">Union</option>   
</select>
        </td>
        <td>
          <select style="width: 170px"  class="form-control " name="bg" id="" required=""  >
  <option value="">Blood group</option>
  @foreach ($bg as $blood)
  <option value="{{$blood->id}}">{{$blood->bg_name}}</option>
  @endforeach
  </select> 
        </td>
        <td>
           <button class="btn btn-xs btn-info"><b>Search Blood</b></button>
        </td>
       
      </tr>
    </table>
 
  </form>
  
  @endif

</div>


            @endsection
            @section ('script')
<script>
   $("#division_id").change(function(){
        var division = $("#division_id").val();
        // Send an ajax request to server with this division
        $("#district_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/get-districts/"+division, function( data ) {

            data = JSON.parse(data);
             option += "<option>"+ "District" +"</option>";
            data.forEach( function(element) {
            
             
              option += "<option value='"+ element.dis_id +"'>"+ element.dis_name_en +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#district_id").html(option);

        });
    })


</script>
<script>
   $("#district_id").change(function(){
        var district = $("#district_id").val();
        // Send an ajax request to server with this division
        $("#upazila_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/get-upazila/"+district, function( data ) {
            option += "<option>"+ "Upazila" +"</option>";
            data = JSON.parse(data);
            
            data.forEach( function(element) {
            
              option += "<option value='"+ element.upa_id +"'>"+ element.upa_name_en +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#upazila_id").html(option);

        });
    })


</script>
<script>
   $("#upazila_id").change(function(){
        var upazila = $("#upazila_id").val();
        // Send an ajax request to server with this division
        $("#union_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/get-union/"+upazila, function( data ) {
            option += "<option>"+ "Union" +"</option>";
            data = JSON.parse(data);
            
            data.forEach( function(element) {
            
              option += "<option value='"+ element.uni_id +"'>"+ element.uni_name_bn +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#union_id").html(option);

        });
    })


</script>

@endsection
             
