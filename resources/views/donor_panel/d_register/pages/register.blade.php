@extends('donor_panel.d_register.r_mastering.master')

@section ('content')

<table class="table">
    <tr>
    <td colspan="8"><b>
        <div class="card-header text-center">
            <p>Donor Registration</p>
            @include('backend.partials.message')   
        </div>
             
    </b>
 <a href="{{ route("donor.login") }}" class="badge  btn-outline-info float-right">login here</a>
</td>
</tr>

<form action="{{route('donor.store')}}" method="post">
    @csrf
    <input class="form-control" type="hidden" name="d_userid" value="{{rand()}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
    <input class="form-control" type="hidden" name="code" value="{{str_random(5)}}" placeholder="Enter Contact Number" required="" autofocus="off" autocomplete="off" />
    <tr>
    <td class="text-right">Name :</td>
        <td colspan=""><b><input class="form-control" type="text" name="d_name" placeholder="Enter Donor Name" required="" autofocus="off" autocomplete="off" /></b></td>
        <td class="text-right">Contact Number :</td>
        
        <td colspan=""><b><input class="form-control" type="text" minlength="11" maxlength="11" name="d_number" placeholder="Enter Contact Number" /></b></td>
     <td class="text-right">E-mail :</td>
        
        <td colspan=""><b><input class="form-control" type="email" name="d_email" placeholder="Enter email" /></b></td>
   
            <td class="text-right">Password :</td>
            <td colspan=""><b><input class="form-control" type="text" name="d_password" placeholder="Enter Password" required="" autofocus="off" autocomplete="off" /></b></td>
    
    
    </tr>
    <tr>
           </tr>
    <tr>
        <td class="text-right">Sex :</td>
        <td colspan="3">
            <b>
                <select class="form-control" name="d_sex" required=""  >
                        <option value="">Select sex!</option>
                        @foreach ($sex as $s)
                        <option value="{{$s->id}}">{{$s->sex_name}}</option>
                        @endforeach
                </select>
            </b>
        </td>
            <td class="text-right">Blood Group :</td>
            <td  colspan="3">
                <b>
                    <select class="form-control" name="d_blood_group" required=""  >
                            <option value="">Select blood group!</option>
                            @foreach ($bg as $bgroup)
                            <option value="{{$bgroup->id}}">{{$bgroup->bg_name}}</option>
                            @endforeach
                    </select>
                </b>
            </td>
</tr>
    <tr>
    <td class="text-right">Date of Birth :</td>
    <td colspan="7">
        <b>
        <input class="form-control" date-format="yyyy-mm-dd"  value="yyyy-mm-dd" placeholder="YYYY-MM-DD"   size="" type="date" value="" name="d_dob">        
        </b>
    </td>
    </tr>
     <tr>
        <td class="text-right">Division :</td>
        <td>
            <b>
                <select class="form-control select2" name="div" id="division_id" required=""  >
                        <option value="">Select Division!</option>
                        @foreach ($Division as $div)
                        <option value="{{$div->div_id}}">{{$div->div_name_en}}</option>
                        @endforeach
                </select>
            </b>
        </td>
            <td class="text-right">District :</td>
            <td>
                <b>
                    <select class="form-control" name="dis" required="" id="district_id"  >
                            <option value="">Select district!</option>
                    </select>
                </b>
            </td>
             <td class="text-right">Upazila :</td>
        <td>
            <b>
                <select class="form-control" name="upa" required=""  id="upazila_id"  >
                        <option value="">Select upazila!</option>    
                </select>
            </b>
        </td>
            <td class="text-right">Union :</td>
            <td>
                <b>
                    <select class="form-control" name="uni" required="" id="union_id" >
                            <option value="">Select union!</option>   
                    </select>
                </b>
            </td>
            </tr>
            <tr>
            <td class="" colspan="8">      
            <button class="btn btn-xs btn-outline-info float-right ">Register</button></td>
            </tr>
            </form>
</table>         
@endsection
@section ('script')
<script>
   $("#division_id").change(function(){
        var division = $("#division_id").val();
        // Send an ajax request to server with this division
        $("#district_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/donor/register/get-districts/"+division, function( data ) {

            data = JSON.parse(data);
             option += "<option>"+ "Select district !" +"</option>";
            data.forEach( function(element) {
            
             
              option += "<option value='"+ element.dis_id +"'>"+ element.dis_name_en +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#district_id").html(option);

        });
    })


</script>
<script>
   $("#district_id").change(function(){
        var district = $("#district_id").val();
        // Send an ajax request to server with this division
        $("#upazila_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/donor/register/get-upazila/"+district, function( data ) {
            option += "<option>"+ "Select upazila !" +"</option>";
            data = JSON.parse(data);
            
            data.forEach( function(element) {
            
              option += "<option value='"+ element.upa_id +"'>"+ element.upa_name_en +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#upazila_id").html(option);

        });
    })


</script>
<script>
   $("#upazila_id").change(function(){
        var upazila = $("#upazila_id").val();
        // Send an ajax request to server with this division
        $("#union_id").html("");
        var option = "";

        $.get( "http://localhost/Blood_management/public/donor/register/get-union/"+upazila, function( data ) {
            option += "<option>"+ "Select union !" +"</option>";
            data = JSON.parse(data);
            
            data.forEach( function(element) {
            
              option += "<option value='"+ element.uni_id +"'>"+ element.uni_name_bn +"</option>";
             // console.log(element.dis_name_en);
            });

          $("#union_id").html(option);

        });
    })


</script>

@endsection
             
