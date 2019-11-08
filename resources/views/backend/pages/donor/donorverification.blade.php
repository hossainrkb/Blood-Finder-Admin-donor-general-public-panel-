@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2><b><i class="fa fa-edit"></i> </b></h2> 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_content">
                                    <table class="table table-condensed text-left">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td colspan="4"><h3><b>Donor Verification</b></h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><b>
                                                            @include('backend.partials.message')    
                                                    </b></td>
                                                </tr>
                                               
                                                <form action="{{route('admin.donor.store.code.verify')}}" method="post">
                                                @csrf
                                            <input class="form-control" type="hidden" name="code" value="{{str_random(10)}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
                                                <tr>
                                                <td class="text-right"><h5><b>Vefification code :</b></h5></td>
                                                    <td colspan=""><b><input class="form-control" type="text" name="v_code" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
                                                <td> <button class="btn btn-md btn-info ">Submit Code</button></td>
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
