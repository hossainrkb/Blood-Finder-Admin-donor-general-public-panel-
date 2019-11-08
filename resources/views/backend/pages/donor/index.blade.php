@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2 class="text-info"><b><i class="fa fa-list"></i> Donors list</b>
                            @include('backend.partials.message')
                            </h2>
                        </div>
                       @php
                           $date = new DateTime;
                          $date->modify('-2 minutes');
                          $formatted_date = $date->format('Y-m-d H:i:s');
                       @endphp
                       {{ $formatted_date }}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_content">
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover text-center" id="d_table">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td><b>Sl#</b></td>
                                                    <td><b>DonorID</b></td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Mobile No</b></td>
                                                    <td><b>Status</b></td>
                                                    <td ><b>Action</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donor as $dnr)
                                               <tr>
                                               <td>{{ $loop->index+1 }}</td>
                                               <td>{{$dnr->d_user_id}}</td>
                                               <td>{{$dnr->name}}</td>
                                               <td>{{$dnr->phone}}</td>
                                               <td>  @if ($formatted_date < $dnr->donor_activity)
                                                <span class="btn-xs btn-success">Online</span>                              
                                                    @else
                                                    <span class="btn-xs btn-warning">Offline</span>
                                                @endif
                                                </td>
                                                <td><a href="{{ route ('admin.donor.edit', $dnr->id) }}" class="btn btn-primary btn-sm"> Edit</a>
                                                    <a href="{{ route ('admin.donor.details', $dnr->id) }}" class="btn btn-info btn-sm"> Details</a>
                                                  <a href="#deleteModal{{ $dnr->id }}" data-toggle="modal"  class="btn btn-info btn-sm"> Delete</a>
                                                  <!-- DeleteModal -->
              <div class="modal fade" id="deleteModal{{ $dnr->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to permanently delete this? </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('admin.donor.delete', $dnr->id)}}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info" >ok,Permanently Delete This donor?</button>

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
