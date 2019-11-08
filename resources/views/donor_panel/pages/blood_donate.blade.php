@extends('donor_panel.d_mastering.master')

@section ('content')

<div class="row">
<div class="col-md-12" id="overflowTest">
  Hello {{  Auth :: guard ('donor')->check() ? Auth :: guard ('donor')->user()->name : '' }} Your Blood request bin !
             {{ Auth :: guard ('donor')->id()  }}
  
          @php 
           $Blood_request = App\Models\Blood_request::where('d_id', Auth :: guard ('donor')->id())->distinct()->orderBy('id','DESC')->get(['r_phone'])
          @endphp
          <div class="row">
              <div class="col-md-12 text-center">
                  <div class="card">
                      <div class="card-header">
                        <b>  Blood Donate</b>
                        <p>
                             @include('backend.partials.message')
                        </p>
                      </div>
                  </div>
              </div>
          </div>
        <table class="table table-condensed text-left">
        <thead>
            @php $donor = App\Models\Donor::where('id',  Auth :: guard ('donor')->id())->first() @endphp
            @php $donate = App\Models\Blood_donate::where('d_id',  Auth :: guard ('donor')->id())->first() @endphp

            <tr>
                <td class="text-right">
                    <b>Donor Name :</b>
                </td>
                <td colspan=""><b>
                        <input class="form-control" value="{{$donor->name}}" size="" type="text"
                            readonly name="s_collection">
                    </b></td>
                <td class="text-right">
                    <b>DonorId :</b>
                </td>
                <td colspan=""><b>
                        <input class="form-control" value="{{$donor->d_user_id}}" size=""
                            type="text" readonly name="s_collection">
                    </b></td>
                <td class="text-right ">
                    <b>Phone: </b>
                </td>
                <td colspan=""><b>
                        <input class="form-control" value="{{$donor->phone}}" size=""
                            type="text" readonly name="s_collection">
                    </b></td>
                </tr>
                @if(is_null($donate))
                <form action="{{route('donor.donate.store_donate')}}" method="post">
                    @csrf
                    <tr>
                        <td class="text-right">
                            <b>Date of donate Blood :</b>
                        </td>
                        <td colspan="5"><b>
                                <input class="form-control" date-format="yyyy-mm-dd"
                                    value="yyyy-mm-dd" placeholder="YYYY-MM-DD" size="" type="date"
                                    name="dod">
                                <input class="form-control" date-format="yyyy-mm-dd" value="{{ Auth :: guard ('donor')->id()  }}"
                                    placeholder="YYYY-MM-DD" size="" type="hidden" name="donor_id">
                            </b></td>

                    </tr>
                    <tr>
                        <td colspan="6">
                            <button type="submit" class="btn float-right btn-outline-success"><b><i
                                        class="fa fa-arrow-circle-right"></i> Add
                                    Donate</b></button>
                        </td>
                    </tr>
                </form>
                @else
                @php
                $current_date = date('Y-m-d');
                $given_date= $donate->dod;
                $d_diff=round(abs(strtotime($current_date)-strtotime($given_date))/86400);
                @endphp
                    @if($d_diff>=90)
                <form action="{{route('donor.donate.update_donate', $donate->id)}}" method="post">
                    @csrf
                    <tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            Last time you donate blood on date: <span
                                class="text-info"><b>{{$donate->dod}}</b></span> , Thank you
                        </td>
                    </tr>
                    <td class="text-right">
                        <b>Updat donate date :</b>
                    </td>
                    <td colspan="5"><b>
                            <input class="form-control" date-format="yyyy-mm-dd" value="{{ Auth :: guard ('donor')->id() }}"
                                placeholder="YYYY-MM-DD" size="" type="hidden" name="donor_id">
                            <input class="form-control" date-format="yyyy-mm-dd" value="yyyy-mm-dd"
                                placeholder="YYYY-MM-DD" size="" type="date" value="" name="u_dod">
                        </b></td>

                    </tr>
                    <tr>
                        <td colspan="6">
                            <button type="submit" class="btn float-right btn-outline-info btn-xs"><b><i
                                        class="fa fa-arrow-circle-right"></i> Update</b></button>
                        </td>
                    </tr>
                </form>
            @else
                <tr>
                    <td colspan="6" class="text-center">
                        You donated blood on date: <span class="text-info"><b>{{$donate->dod}}</b></span> ,
                        Thank you. <br>
                        Next time you have to wait 3 months at least for donating blood.
                    </td>
                </tr>
                @endif
   
                                </thead>
                                <tfoot>

                                  @endif
                                </tfoot>
                            </table>
                             <div class="card-footer">
                       
                      </div>
    
             
              </div>
               </div>



      
      
               
             
            @endsection
             
