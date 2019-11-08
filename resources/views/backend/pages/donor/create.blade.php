@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2 class="text-info"><b><i class="fa fa-edit"></i> </b></h2> 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_content">
                                    <table class="table table-condensed text-left">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td colspan="4"><h3><b>New Donor's Information</b></h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><b>
                                                            @include('backend.partials.message')    
                                                    </b></td>
                                                </tr>
                                               
                                                <form action="{{route('admin.donor.store')}}" method="post">
                                                    @csrf
                                                     <input class="form-control" type="hidden" name="d_userid" value="{{rand()}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
                                                    <input class="form-control" type="hidden" name="code" value="{{str_random(5)}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
   
                                                    <tr>
                                                    <td class="text-right text-info"><h5><b>Name :</b></h5></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="d_name" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
                                                        <td class="text-right text-info"><h5><b>Contact Number :</b></h5></td>
                                                       
                                                        <td colspan=""><b><input class="form-control" type="text" minlength="11" maxlength="11" name="d_number" placeholder="Enter Contact Number" /></b></td>
                                                    </tr>
                                                    <tr>
                                                         <td class="text-right text-info"><h5><b>E-mail :</b></h5></td>
                                                         <td colspan=""><b><input class="form-control" type="email" name="d_email" placeholder="Enter email" /></b></td>
                                                            <td class="text-right text-info"><h5><b>Password :</b></h5></td>
                                                            <td colspan=""><b><input class="form-control" type="text" name="d_password" placeholder="Enter Password" required="" autofocus="off" autocomplete="off" /></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right text-info"><h5><b>Sex :</b></h5></td>
                                                        <td>
                                                            <b>
                                                                <select class="form-control" name="d_sex" required=""  >
                                                                        <option value="">Select sex!</option>
                                                                        @foreach ($sex as $s)
                                                                        <option value="{{$s->id}}">{{$s->sex_name}}</option>
                                                                        @endforeach
                                                                </select>
                                                            </b>
                                                        </td>
                                                            <td class="text-right text-info"><h5><b>Blood Group :</b></h5></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_blood_group" required=""  >
                                                                          <option value="">Select blood group!</option>
                                                                          @foreach ($bg as $bgroup)
                                                                          <option value="{{$bgroup->id}}">{{$bgroup->bg_name}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                              </tr>
                                                    <tr>
                                                            <td class="text-right text-info"><h5><b>Date of Birth :</b></h5></td>
                                                            <td colspan="3"><b>
                                                                <input class="form-control" date-format="yyyy-mm-dd"  value="yyyy-mm-dd" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="d_dob">        
                                                                </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-info pull-left" href="{{ route('admin') }}"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                            <button type="submit" class="btn pull-right btn-info"><b><i class="fa fa-arrow-circle-right"></i> Add Donor</b></button>
                                                        </td>
                                                    </tr>
             
                                                </form>
                                               
                                            </thead>
                                            <tfoot>
                                                <tr class="btn-info text-center">
                                                    <td colspan="4"><b></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
            
            @endsection
