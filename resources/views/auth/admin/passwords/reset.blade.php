@extends('auth.admin.b_mastering.master')
@section ('content')

        <div class="container">
              <div class="row " style="margin-top: 50px">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                  <div class="panel panel-info">
               
                    <table class="table">
                        <thead>
                     
                      <tr>
                        <td >


                            <div align="center" style="color: #343434; font-size: 40px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 55px;" class="main-header">

                               <span style="color: red;">BLOOD</span> Finder
                           
                               

                            </div>
                            <span style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-left: 150px"><b>We are here to share hands.</b></span>
                        </td>
                    </tr>
                            <tr class="btn-info" >
                                <td style="color: white;" class="text-center"><h1 style="color: white;"><b>Reset Password</b></h1>
                               <h6 style="color: white;"><b>@include('backend.partials.message')</b></h6> 
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <div class="panel-body">
                           <form method="POST" action="{{ route('admin.password.update') }}">
                                    @csrf
                                
                           
                                <b class="text-danger">Email</b>
                                <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                <b><input type="email" name="email" value="{{$Admin->a_email}}" class="form-control" placeholder="Enter your email" required="" autocomplete="off"  /></b>
                                </div>
                                <b class="text-danger">Password</b>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <b><input type="password" name="password" class="form-control"  placeholder="Enter your password" minlength="6" required=""/></b>
                                </div>
                               
                                <button type="submit" name="submit" class="btn btn-info btn-block"><i class="fa fa-key"></i> <b>Reset</b></button>
                            </form>
                      </div>
                      <div class="panel-footer text-center">
                          <b><a href="{{ route('admin.login') }}">Login now?</a></b>
                      </div>
                    </div>
              </div>  
            <div class="col-md-4"></div>
        </div>
        </div>
       

            
            @endsection
