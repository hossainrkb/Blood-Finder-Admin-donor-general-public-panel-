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
                                                    <td colspan="4"><h3><b>Add slide</b></h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><b>
                                                            @include('backend.partials.message')    
                                                    </b></td>
                                                </tr>
                                               
                                                <form action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input class="form-control" type="hidden" name="d_userid" value="{{rand()}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
                                                    <tr>
                                                    <td class="text-right text-info"><h5><b>Title :</b></h5></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="title" placeholder="Enter your title" required="" autofocus="off" autocomplete="off" /></b></td>
                                                        <td class="text-right text-info"><h5><b>Image :</b></h5></td>
                                                       
                                                        <td colspan=""><b><input type="file" name="img" class="form-control" id="" ></b></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-right text-info"><h5><b>Priority :</b></h5></td>
                                                        <td colspan="3"><b><input class="form-control" type="number" name="prio" placeholder="Enter your priority" required="" autofocus="off" autocomplete="off" /></b></td>
                                                       
                                                      </tr>
                                                    <tr>
                                                    <td class="text-right text-info"><h5><b>Button :</b></h5></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="button" placeholder="Enter button Name" required="" autofocus="off" autocomplete="off" /></b></td>
                                                        
                                                    <td class="text-right text-info"><h5><b>Link :</b></h5></td>
                                                        <td colspan=""><b><input class="form-control" type="text" name="link" placeholder="Enter link" required="" autofocus="off" autocomplete="off" /></b></td>
                                                         </tr>
                                                 
                                                  
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-info pull-left" href="{{ route('admin') }}"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                            <button type="submit" class="btn pull-right btn-info"><b><i class="fa fa-arrow-circle-right"></i> Add Slide</b></button>
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
