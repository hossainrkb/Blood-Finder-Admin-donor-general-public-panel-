@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
  Hello {{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user()->name : '' }} Your Blood request bin !
             
  
  {{ Auth :: guard ('donor')->id()  }}
           @include('backend.partials.message')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                
                                    <div class="x_content">
                                    <table class="table table-condensed table-striped text-left">
                                            <tbody>
                                                <form action="{{route('donor.update', $edit_donor->id)}}" method="post">
                                                    @csrf
                                                    <tr>
                                                    <td class="text-right"><b>Name :</b></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="d_name" value="{{$edit_donor->name}}" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
                                                        <td class="text-right"><b>Contact Number :</b><b></td>

                                                        <td colspan=""><b><input class="form-control" type="text" value="{{$edit_donor->phone}}" minlength="11" maxlength="11" name="d_number" placeholder="Enter Contact Number" /></b></td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text-right"><b>Email :</b><b></td>
                                                                <td colspan="3"><b><input class="form-control" type="text" name="d_email"value="{{$edit_donor->email}}"   placeholder="Enter Donor Name"  autofocus="off" autocomplete="off" /></b></td>
                                                                </tr>
                                                    
                                                    <tr>
                                                        <td class="text-right"><b>Sex :</b><b></td>
                                                        <td>
                                                            <b>
                                                                <select class="form-control" name="d_sex">
                                                                        <option value="">Select Sex!</option>
                                                                        @foreach ($sex as $s)
                                                                        <option value="{{$s->id}}"  @if($edit_donor->sex_id==$s->id) selected @endif > {{$s->sex_name}} </option>
                                                                        @endforeach
                                                                </select>
                                                            </b>
                                                        </td>
                                                            <td class="text-right"><b>Blood Group :</b><b></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_blood_group" required=""  >
                                                                          <option value="">Select blood group!</option>
                                                                          @foreach ($bg as $bgroup)
                                                                          <option value="{{$bgroup->id}}" @if($edit_donor->blood_group_id==$bgroup->id) selected @endif>{{$bgroup->bg_name}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                              </tr>
                                                    <tr>
                                                            <td class="text-right"><b>Date of Birth :</b><b></td>
                                                            <td colspan="3"><b>
                                                            <input class="form-control" date-format="yyyy-mm-dd"  value="{{$edit_donor->dob}}" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="d_dob">
                                                                </b></td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text-right"><b>Division :</b><b></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_div" required="" disabled=""  >
                                                                          <option value="">Select division!</option>
                                                                          @foreach ($division as $div)
                                                                          <option value="{{$div->div_id}}" @if($edit_donor->d_division==$div->div_id) selected @endif>{{$div->div_name_en}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                                            <td class="text-right"><b>District :</b><b></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_dis" required="" disabled=""  >
                                                                          <option value="">Select district!</option>
                                                                          @foreach ($district as $dis)
                                                                          <option value="{{$dis->dis_id}}" @if($edit_donor->d_district==$dis->dis_id) selected @endif>{{$dis->dis_name_en}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text-right"><b>Upazila :</b><b></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_upa" required="" disabled=""  >
                                                                          <option value="">Select upazila!</option>
                                                                          @foreach ($upazila as $upa)
                                                                          <option value="{{$upa->upa_id}}" @if($edit_donor->d_upazila==$upa->upa_id) selected @endif>{{$upa->upa_name_en}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                                            <td class="text-right"><b>Union :</b><b></td>
                                                            <td>
                                                                <b>
                                                                    <select class="form-control" name="d_uni" required="" disabled=""  >
                                                                          <option value="">Select union!</option>
                                                                          @foreach ($union as $uni)
                                                                          <option value="{{$uni->uni_id}}" @if($edit_donor->d_union==$uni->uni_id) selected @endif>{{$uni->uni_name_bn}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-danger pull-left" href="{{ route("donor.details") }}"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                            <button type="submit" class="btn btn-outline-info float-right"><b><i class="fa fa-arrow-circle-right"></i> Update</b></button>
                                                        </td>
                                                    </tr>

                                                </form>

                                            </tbody>
                                            <tfoot>
                                                <tr class="btn-danger text-center">
                                                    <td colspan="4"><b></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                                
                     
                     <!-- End Form Elements -->
                </div>
            </div>
  

    

              </div>
               </div>
            @endsection
            
             
