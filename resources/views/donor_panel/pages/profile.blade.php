@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
     @include('backend.partials.message')
  Hello {{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user()->name : '' }} Your Blood request bin !
             
  
  {{ Auth :: guard ('donor')->id()  }}

  <div class="row">
      <div class="col-md-12 text-right">
          <a href="#updatepass{{  Auth :: guard ('donor')->id()  }}" data-toggle="modal" class="badge btn-outline-danger">Change password</a>
          <a href="{{ route('donor.edit', Auth :: guard ('donor')->id() ) }}" class="badge btn-outline-info">Edit your info</a>
       
                                                            
                                                                        <!-- [change password] -->
              <div class="modal fade" id="updatepass{{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->id() : ''   }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Change Password?</b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('donor.pass.update', Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->id() : ''  )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped text-info">
                               <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Current Password: </b></td>
                                   <td><input minlength="8" required  type="password" class="form-control" name="c_pass"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>New: </b></td>
                                   <td><input  minlength="8" required type="password" class="form-control" name="n_pass"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Re-type Password: </b></td>
                                   <td><input  minlength="8" required type="password" class="form-control" name="re_pass"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input  type="submit" value="Save changes" class="btn btn-danger btn-xs pull-right">
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
        </div>
  </div>
   @php 
   $detail_donor= Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user():'';
     $donor_log =  App\Models\Blood_donate_log::orderBy('id', 'desc')->where('d_id', Auth :: guard ('donor')->id() )->get();
  @endphp
         <table class="table  table-condensed table-striped">
            <tbody>
                <tr>
                    <td>
                <table class="table  table-condensed table-striped table-hover">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2">
                                    @if($detail_donor->d_image)
                                        <img class="img img-thumbnail" width="100" height="100" src="{{asset('img/donors/'. $detail_donor->d_image ) }}">
                                    
                                    @else
                                        <img class="img img-thumbnail " src="{{asset('img/mango_prople.png' ) }}" width="120" height="100" />
                                    
                                    @endif
                                      <br>
                                      
                                    <a href="#updateDP{{ $detail_donor->id }}" data-toggle="modal"  class="bedge-primary"><b>update DP</b></a>
                                                                        
                                                                            <!-- u[dateModel] -->
                                    <div class="modal fade" id="updateDP{{ $detail_donor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Display picture </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form action="{{route('donor.dp',$detail_donor->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                <table class="table table-hover table-condensed table-striped">
                                                    <tr>
                                                        <td>Update DP</td>
                                                        <td><input type="file" name="dp" class="form-control" id="" ></td>
                                                        <td><button type="submit" class="btn btn-info btn-md"><i class="fa fa-1x fa-check-circle"></i> Update</button></td>
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
                                    <tr>
                                        <td colspan="2" class=" text-center">
                                            <span class="badge"><b class="">Donor Type :
                                            @if(count($donor_log)>= 5)
                                            <span class="badge" style="color: cyan   "> <i class="fas fa-trophy fa-2x"></i> Platinum</span>
                                            @elseif(count($donor_log)>= 3)
                                            <span class="badge"  style="color: #FFDF00   "> <i class="fas fa-trophy fa-2x"></i> Gold</span>
                                            @elseif(count($donor_log)>= 2)
                                            <span class="badge"  style="color: #D3D3D3   "> <i class="fas fa-trophy fa-2x"></i> Silver</span>
                                            @else
                                            <span class="badge" style="color: red   "> <i class="fas fa-trophy fa-2x"></i> General</span>
                                            @endif                              
                                            </b></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                    <td colspan="2" class="text-center"><b>DonorID :  {{$detail_donor->d_user_id}}</b></td>
                                    </tr>
                                    
                                      <tr>
                                <td class="text-right"><b>Donor Name :</b></td>
                                <td><b>{{$detail_donor->name}}</b></td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Mobile Number :</b></td>
                                <td><b>{{$detail_donor->phone}}</b></td>
                            </tr>
                          
                                </tbody>
                            </table>
                        </td>
                        <td>
                    <table class="table table-striped table-condensed table-hover">
                        <tbody>
                            <tr>
                                <td class="text-right"><b>E-mail :</b></td>
                                <td><b>{{$detail_donor->email}}</b></td>
                            </tr>
                            
                            <tr>
                                <td class="text-right"><b>Date Of Birth :</b></td>
                                <td><b>{{$detail_donor->dob}}</b></td>
                            </tr>
                            <tr>
                                    <td class="text-right"><b>Sex :</b></td>
                                    
                                    <td><b>
                                            @foreach ($sex as $s)
                                            @if($detail_donor->sex_id==$s->id) {{$s->sex_name}} @endif
                                        @endforeach
                                    </b>
                                    </td>
                                    
                                </tr>
                                <tr>
                                        <td class="text-right"><b>Blood group :</b></td>
                                        
                                        <td><b>
                                                @foreach ($bg as $bgroup)
                                                @if($detail_donor->blood_group_id==$bgroup->id) {{$bgroup->bg_name}} @endif
                                            @endforeach
                                        </b>
                                        </td>
                                    </tr>
                                <tr>
                                        <td class="text-right"><b>Division :</b></td>
                                        
                                        <td><b>
                                                @foreach ($division as $div)
                                                @if($detail_donor->d_division==$div->div_id) {{$div->div_name_en}} @endif
                                            @endforeach
                                        </b>
                                        </td>
                                    </tr>
                                <tr>
                                        <td class="text-right"><b>District :</b></td>
                                        
                                        <td><b>
                                                @foreach ($district as $dis)
                                                @if($detail_donor->d_district==$dis->dis_id) {{$dis->dis_name_en}} @endif
                                            @endforeach
                                        </b>
                                        </td>
                                    </tr>
                                <tr>
                                        <td class="text-right"><b>Upazila :</b></td>
                                        
                                        <td><b>
                                                @foreach ($upazila as $upa)
                                                @if($detail_donor->d_upazila==$upa->upa_id) {{$upa->upa_name_en}} @endif
                                            @endforeach
                                        </b>
                                        </td>
                                    </tr>
                                <tr>
                                        <td class="text-right"><b>Union :</b></td>
                                        
                                        <td><b>
                                                @foreach ($union as $uni)
                                                @if($detail_donor->d_union==$uni->uni_id) {{$uni->uni_name_bn}} @endif
                                            @endforeach
                                        </b>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <!-- log list-->

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
             <p><b><i class="fa fa-list"></i> Your donate history </b></p>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <td><b>#Sl</b></td>
                <td ><b>Donate date</b></td>
            </tr>
        </thead>
         <tbody>
        @foreach ($donor_log as $bdl)
        <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{$bdl->dod}}</td>
        </tr>
        @endforeach
    </tbody>
        <tfoot>
            <tr>
               <td></td>
               <td></td>
            </tr>
        </tfoot>
    </table>
        </div>
        <div class="col-md-3"></div>
    </div>

              </div>
               </div>
            @endsection
             
