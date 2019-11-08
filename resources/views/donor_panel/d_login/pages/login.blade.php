@extends('donor_panel.d_login.l_mastering.master')

@section ('content')

<table class="table">
    <tr>
    <td colspan="4"><b>
        <div class="card-header text-center">
            <p>Donor Login</p>
            
            @include('backend.partials.message')   
        </div>
             
    </b>
<a href="{{ route("donor.password.request") }}" class="badge  btn-outline-danger float-right">forget password ?</a>
 <a href="{{ route("donor.register") }}" class="badge  btn-outline-primary float-right">not register yet ?</a>
</td>
</tr>
  <form action="{{ route('donor.login.submit') }}" method="post" >
       @csrf
        <tr>
            <td class="text-right">
                <b>Email: </b>
            </td>
            <td>
                <input type="email" name="email" class="form-control" placeholder="puts your mail..">
            </td>
        </tr>
        <tr>
            <td class="text-right">
                <b>Password: </b>
            </td>
            <td>
                 <input type="password" name="password" class="form-control" placeholder="puts your password..">
            </td>
        </tr>
        <tr style="">
            <td colspan="2">      
                <button class="btn btn-outline-success btn-xs float-right" ><b>login?</b></button>
            </td>
        </tr>
 

                    </table>
                
            </td>
        </tr>
    </form>
</table>
               
             
            @endsection
             
