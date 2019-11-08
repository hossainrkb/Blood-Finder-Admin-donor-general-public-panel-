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
                                    <table class="table table-condensed table-striped text-left">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td colspan="4"><h3><b>Update Donor's Information</b></h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><b>
                                                            @include('backend.partials.message')
                                                    </b></td>
                                                </tr>

                                                <form action="{{route('admin.donor.update', $edit_donor->id)}}" method="post">
                                                    @csrf
                                                    <tr>
                                                    <td class="text-right text-info"><h5><b>Name :</b></h5></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="d_name" value="{{$edit_donor->name}}" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
                                                        <td class="text-right text-info"><h5><b>Contact Number :</b></h5></td>

                                                        <td colspan=""><b><input class="form-control" type="text" value="{{$edit_donor->phone}}" minlength="11" maxlength="11" name="d_number" placeholder="Enter Contact Number" /></b></td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text-right text-info"><h5><b>Email :</b></h5></td>
                                                                <td colspan="3"><b><input class="form-control" type="text" name="d_email"value="{{$edit_donor->email}}"   placeholder="Enter Donor Name"  autofocus="off" autocomplete="off" /></b></td>
                                                                </tr>
                                                    
                                                    <tr>
                                                        <td class="text-right text-info"><h5><b>Sex :</b></h5></td>
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
                                                            <td class="text-right text-info"><h5><b>Blood Group :</b></h5></td>
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
                                                            <td class="text-right text-info"><h5><b>Date of Birth :</b></h5></td>
                                                            <td colspan="3"><b>
                                                            <input class="form-control" date-format="yyyy-mm-dd"  value="{{$edit_donor->dob}}" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="d_dob">
                                                                </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-info pull-left" href="{{ route('admin.donor') }}"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                            <button type="submit" class="btn pull-right btn-info"><b><i class="fa fa-arrow-circle-right"></i> Update Donor</b></button>
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
