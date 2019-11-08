
@if(Auth :: guard ('admin')->check())

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
                                                            <h2 style="color: whitesmoke;"><i class="fa fa-user"></i> <b>Admin Profile</b>
                                                            <span class="pull-right">
                                                                <a  href="#updateDP{{  Auth :: guard ('admin')->id()  }}" data-toggle="modal"  class="btn btn-info btn-xs"><b>Change Password</b></a>
                                                            
                                                                        <!-- [change password] -->
              <div class="modal fade" id="updateDP{{  Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->id() : ''   }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">Change Password?</b> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                           
                        <form action="{{route('admin.pass.update', Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->id() : ''  )}}" method="post" enctype="multipart/form-data">
                            @csrf
                           <table class="table table-bordered table-hover table-condensed table-striped text-info">
                               <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Current Password: </b></td>
                                   <td><input minlength="8" required  type="password" class="form-control" name="c_pass"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>New: </b></td>
                                   <td><input  minlength="8" required type="password" class="form-control" name="n_pass"></td>
                                </tr>
                                   <tr>
                                   <td style="font-size: 15px;text-align: right"><b>Re-type Password: </b></td>
                                   <td><input  minlength="8" required type="password" class="form-control" name="re_pass"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input  type="submit" value="Save changes" class="btn btn-info btn-xs pull-right">
                                    </td>
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
                                                            </span>
                                                            </h2>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

<td>
    <table class="table table-striped table-condensed table-hover">
        <tbody>
            <tr>
                <td class="text-right"><b>Admin Name :</b></td>
                <td><b>{{  Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->user()->a_name : '' }}</b></td>
            </tr>
            <tr>
                <td class="text-right"><b>Mobile Number :</b></td>
              
                <td><b>{{  Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->user()->a_phone : '' }}</b></td>
            </tr>
            <tr>
                <td class="text-right"><b>E-mail :</b></td>
                <td><b>{{  Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->user()->a_email : '' }}</b></td>
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
</table
                                        </div>              
                                    </div>
                                </div>
                            </div>
                             <!-- End Form Elements -->
                        </div>
               </div>
             
            @endsection
               @else

              
               <script type="text/javascript">
    window.location = "{{{ url('admin/login') }}}";//here double curly bracket
</script>
           
           @endif
            
