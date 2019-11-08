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
                                                    <td colspan="4"><h3><b>Blood stock information</b></h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><b>
                                                            @include('backend.partials.message')    
                                                    </b></td>
                                                </tr>
                                               
                                                <form action="{{route('admin.stock.store')}}" method="post">
                                                    @csrf
                                                    <tr>
                                                        
                                                            <td class="text-right text-info"><h5><b>Blood Group :</b></h5></td>
                                                            <td colspan="3">
                                                                <b>
                                                                    <select class="form-control" name="s_blood_group" required=""  >
                                                                          <option value="">Select blood group!</option>
                                                                          @foreach ($bg as $bgroup)
                                                                          <option value="{{$bgroup->id}}">{{$bgroup->bg_name}}</option>
                                                                          @endforeach
                                                                    </select>
                                                                </b>
                                                            </td>
                                              </tr>
                                                    <tr>
                                                            <td class="text-right text-info"><h5><b>Collection date :</b></h5></td>
                                                            <td colspan=""><b>
                                                                <input class="form-control" date-format="yyyy-mm-dd"  value="yyyy-mm-dd" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="s_collection">        
                                                                </b></td>
                                                                <td class="text-right text-info"><h5><b>Expiration date  :</b></h5></td>
                                                            <td colspan=""><b>
                                                                <input class="form-control" date-format="yyyy-mm-dd"  value="yyyy-mm-dd" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="s_expiration">        
                                                                </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-info pull-left" href="{{ route("admin") }}"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                            <button type="submit" class="btn pull-right btn-info"><b><i class="fa fa-arrow-circle-right"></i> Add Stock</b></button>
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
