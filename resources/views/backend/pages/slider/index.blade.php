@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2><b><i class="fa fa-list"></i> Donors list</b>
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
                                                    <td><b>Title</b></td>
                                                    <td><b>Image</b></td>
                                                    <td><b>Button</b></td>
                                                    <td><b>Link</b></td>
                                                    <td ><b>Priority</b></td>
                                                    <td ><b>Action</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($slider as $sli)
                                               <tr>
                                               <td>{{ $loop->index+1 }}</td>
                                               <td>{{$sli->title}}</td>
                                               <td>{{$sli->image}}</td>
                                               <td>{{$sli->button}}</td>
                                               <td>{{$sli->link}}</td>
                                               <td>{{$sli->priority}}</td>
                                               
                                                <td><a href="{{ route ('admin.donor.edit', $sli->id) }}" class="btn btn-primary btn-sm"> Edit</a>
                                                  <a href="#deleteModal{{ $sli->id }}" data-toggle="modal"  class="btn btn-info btn-sm"> Delete</a>
                                                  <!-- DeleteModal -->
              <div class="modal fade" id="deleteModal{{ $sli->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to permanently delete this? </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('admin.slider.delete', $sli->id)}}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info" >ok,Permanently Delete This slide?</button>

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
