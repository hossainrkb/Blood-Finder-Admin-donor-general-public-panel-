@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2 class="text-info"><b><i class="fa fa-list"></i> Blood stock details </b>
                            @include('backend.partials.message')
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_content">
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover text-center" id="d_table">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td><b>Sl#</b></td>
                                                    <td><b>Blood group</b></td>
                                                    <td><b>Collection date</b></td>
                                                    <td><b>Expiration date</b></td>
                                                    <td ><b>Action</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($blood_stock as $bs)
                                               <tr>
                                               <td>{{ $loop->index+1 }}</td>
                                               <td>
                                                @foreach ($blood_group as $bgroup)
                                                    @if($bs->blood_id==$bgroup->id) {{$bgroup->bg_name}} @endif
                                                @endforeach
                                               </td>
                                               <td>{{$bs->c_date}}</td>
                                               <td>{{$bs->e_date}}</td>
                                                <td><a href="#updateModal{{ $bs->id }}" data-toggle="modal"  class="btn btn-info btn-sm"> Update</a>
                                                  <a href="#deleteModal{{ $bs->id }}" data-toggle="modal"  class="btn btn-warning btn-sm"> Delete</a>
                                                
                                                                                    <!-- updatemodel -->
              <div class="modal fade" id="updateModal{{ $bs->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                <table class="table table-condensed text-left">
                                        <thead>
                                            <tr class="btn-info text-center">
                                                <td colspan="4"><h3><b>Update stock for @foreach ($blood_group as $bgroup)
                                                        @if($bs->blood_id==$bgroup->id) <span class="btn btn-sm btn-warning"><b>{{$bgroup->bg_name}}</b></span> blood group @endif
                                                    @endforeach </b></h3></td>
                                            </tr>
                                           
                                           
                                            <form action="{{route('admin.stock.update',$bs->id)}}" method="post">
                                                @csrf
                                                
                                                <tr>
                                                        <td class="text-right text-info"><h5><b>Collection date :</b></h5></td>
                                                        <td colspan=""><b>
                                                        <input class="form-control" date-format="yyyy-mm-dd"  size="" type="date" value="{{$bs->c_date}}" name="s_collection">        
                                                            </b></td>
                                                            <td class="text-right text-info"><h5><b>Expiration date  :</b></h5></td>
                                                        <td colspan=""><b>
                                                            <input class="form-control" date-format="yyyy-mm-dd"    size="" type="date" value="{{$bs->e_date}}" name="s_expiration">        
                                                            </b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <button type="submit" class="btn pull-right btn-info"><b><i class="fa fa-arrow-circle-right"></i> Update Stock</b></button>
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
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    
                        </div>
                      </div>
                    </div>
                  </div>
                                                
                                                
                                                  <!-- DeleteModal -->
              <div class="modal fade" id="deleteModal{{ $bs->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to permanently delete this? </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('admin.stock.delete', $bs->id)}}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info" >ok,Permanently Delete This?</button>

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
                                               @endforeach
                                            </tbody>
                                            <tfoot class="btn-info">
                                                <tr>
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
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>

            @endsection
