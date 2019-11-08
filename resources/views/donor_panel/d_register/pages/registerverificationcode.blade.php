@extends('donor_panel.d_register.r_mastering.master')

@section ('content')

<div class="row">
    <div class="col-md-3"></div>
<div class="col-md-6">
<table class="table">
    <tr>
    <td colspan="3"><b>
        <div class="card-header text-center">
            <p>Donor Verification</p>
            @include('backend.partials.message')   
        </div>
             
    </b>

</td>
</tr>

<form action="{{route('donor.store.code.verify')}}" method="post">
    @csrf
   <input class="form-control" type="hidden" name="code" value="{{str_random(10)}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
    <tr>
    <td class="text-right">Vefification code :</td>
        <td colspan=""><b><input class="form-control" type="text" name="v_code" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
    <td> <button class="btn btn-xs btn-outline-info ">Submit Code</button></td>
    </tr>
 
            </form>
</table>     
</div> 
<div class="col-md-3"></div>   
</div>        
@endsection
@section ('script')
@endsection
             
