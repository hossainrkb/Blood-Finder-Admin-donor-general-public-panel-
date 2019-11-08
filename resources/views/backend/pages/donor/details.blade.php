@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
<div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default btn-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                             <table class="table table-bordered table-condensed table-striped">
                                                <thead>
                                                        <tr>
                                                                <td colspan="2"><b>
                                                                        @include('backend.partials.message')
                                                                </b></td>
                                                            </tr>
                                                    <tr class="btn-info">
                                                        <th colspan="4"> 
                                                            <h2 style="color: whitesmoke;"><i class="fa fa-user"></i> <b>Donor Profile</b>
                                                            <span class="pull-right">
                                                                
                                                            </span>
                                                            </h2>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="table table-bordered table-condensed table-striped table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center" colspan="2">
                                                                                @if($detail_donor->d_image)
                                                                                    <img class="img img-thumbnail img-responsive btn " width="100" height="100" src="{{asset('img/donors/'. $detail_donor->d_image ) }}">
                                                                                
                                                                                @else
                                                                                    <img class="img img-thumbnail img-responsive btn " src="{{asset('img/donors/member.jpg' ) }}" width="100" height="100" />
                                                                                
                                                                                @endif
                                                                                
                                                                               
                                                                           
                                                                                                                                                    
                                                                            <br>
                                                                            <a href="#updateDP{{ $detail_donor->id }}" data-toggle="modal"  class="btn btn-primary btn-xs"><b>update DP</b></a>
                                                                        
                                                                            <!-- u[dateModel] -->
              <div class="modal fade" id="updateDP{{ $detail_donor->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to permanently delete this? </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('admin.donor.dp',$detail_donor->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped">
                               <tr>
                                   <td>Update DP</td>
                                   <td><input type="file" name="dp" class="form-control" id="" ></td>
                                   <td><button type="submit" class="btn btn-success btn-md"><i class="fa fa-1x fa-check-circle"></i> Update</button></td>
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
                                                                    <td colspan="2" class="text-center"><b>DonorID :  {{$detail_donor->d_user_id}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" class=" text-center">
                                                                            <span class="badge"><b class="">Donor Type :
                                                                            @if(count($donor_log)>= 5)
                                                                          <span style="color: cyan   "> <i class="fas fa-trophy fa-1x"></i> Platinum</span>
                                                                          @elseif(count($donor_log)>= 3)
                                                                          <span style="color: #FFDF00   "> <i class="fas fa-trophy fa-1x"></i> Gold</span>
                                                                          @elseif(count($donor_log)>= 2)
                                                                          <span style="color: #D3D3D3   "> <i class="fas fa-trophy fa-1x"></i> Silver</span>
                                                                          @else
                                                                          <span style="color: red   "> <i class="fas fa-trophy fa-1x"></i> General</span>
                                                                            @endif
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            </b></span> 
                                                                        </td>
                                                                    </tr>
                                                                   
                                                                
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table class="table table-striped table-condensed table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-right"><b>Donor Name :</b></td>
                                                                        <td><b>{{$detail_donor->name}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-right"><b>Mobile Number :</b></td>
                                                                        <td><b>{{$detail_donor->phone}}</b></td>
                                                                    </tr>
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
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" class="btn-info"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        
                                                       
                                                        
                                                       
                                                        
                                    </div>
                                </div>
                            </div>
                             <!-- End Form Elements -->
                        </div>

                    </div>
                    <!-- log list-->

                            <div class="row">
                                <div class="col-md-12">
                                     <p><b><i class="fa fa-list"></i> Your donate history </b></p>
                                   
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover text-center" id="d_table">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td><b>Sl#</b></td>
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
                                            <tfoot class="btn-info">
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                               
                                </div>
                            </div>
                        
                   
                     <!-- End Form Elements -->
                
               

            @endsection
