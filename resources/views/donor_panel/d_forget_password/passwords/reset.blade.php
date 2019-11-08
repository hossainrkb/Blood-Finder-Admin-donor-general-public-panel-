@extends('donor_panel.d_login.l_mastering.master')

@section ('content')

<table class="table">
    <tr>
    <td colspan="4"><b>
        <div class="card-header text-center">
            <p>Change your password</p>
            
            @include('backend.partials.message')   
        </div>
             
    </b>
<a href="{{ route("donor.register") }}" class="badge  btn-outline-warning float-right">not register yet ?</a>
 <a href="{{ route("donor.login") }}" class="badge  btn-outline-info float-right">login here</a>
</td>
</tr>
  <form action="{{ route('donor.password.update') }}" method="post" >
       @csrf
        <tr>
            <td class="text-right">
                <b>Email: </b>
            </td>
            <td>
                <input type="email" name="email" class="form-control" value="{{ $Donor->email }}" placeholder="puts your mail..">
            </td>
        </tr>
            <tr>
            <td class="text-right">
                <b>New Password: </b>
            </td>
            <td>
                 <input type="password" name="password" class="form-control" placeholder="puts your password..">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="">
                  <button class="btn btn-outline-info btn-xs float-right" ><b>Update new password</b></button>
                 </td>
        </tr>
        
    </form>
</table>
               
             
            @endsection
             
