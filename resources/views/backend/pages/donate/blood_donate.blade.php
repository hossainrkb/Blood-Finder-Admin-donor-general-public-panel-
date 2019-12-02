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
                                        <td colspan="6">
                                            <h3><b>Blood Donate Information</b></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>
                                                @include('backend.partials.message')
                                            </b></td>
                                    </tr>
                                    @php
                                    $id = Input::get('d_id')
                                    @endphp

                                    @if($id)
                                    @php $donor = App\Models\Donor::where('id', $id)->first() @endphp
                                    @php $donate = App\Models\Blood_donate::where('d_id', $id)->first() @endphp

                                    <tr>
                                        <td class="text-right text-info">
                                            <h5><b>Donor Name :</b></h5>
                                        </td>
                                        <td colspan=""><b>
                                                <input class="form-control" value="{{$donor->name}}" size="" type="text"
                                                    readonly name="s_collection">
                                            </b></td>
                                        <td class="text-right text-info">
                                            <h5><b>DonorId :</b></h5>
                                        </td>
                                        <td colspan=""><b>
                                                <input class="form-control" value="{{$donor->d_user_id}}" size=""
                                                    type="text" readonly name="s_collection">
                                            </b></td>
                                        <td class="text-right text-info">
                                            <h5><b>Phone</b></h5>
                                        </td>
                                        <td colspan=""><b>
                                                <input class="form-control" value="{{$donor->phone}}" size=""
                                                    type="text" readonly name="s_collection">
                                            </b></td>

                                    </tr>

                                    @if(is_null($donate))
                                    <form action="{{route('admin.donate.store_donate')}}" method="post">
                                        @csrf
                                        <tr>
                                            <td class="text-right text-info">
                                                <h5><b>Date of donate Blood :</b></h5>
                                            </td>
                                            <td colspan="5"><b>
                                                    <input class="form-control" date-format="yyyy-mm-dd"
                                                        value="yyyy-mm-dd" placeholder="YYYY-MM-DD" size="" type="date"
                                                        name="dod">
                                                    <input class="form-control" date-format="yyyy-mm-dd" value="{{$id}}"
                                                        placeholder="YYYY-MM-DD" size="" type="hidden" name="donor_id">
                                                </b></td>

                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <a class="btn btn-info pull-left" href="{{ route('admin.donate.create') }}"><b><i
                                                            class="fa fa-reply-all"></i> Back</b></a>
                                                <button type="submit" class="btn pull-right btn-info"><b><i
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
                                    {{$d_diff}}
                                    @if($d_diff>=90)
                                    <form action="{{route('admin.donate.update_donate', $donate->id)}}" method="post">
                                        @csrf
                                        <tr>
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Last time you donate blood on date: <span
                                                    class="text-info">{{$donate->dod}}</span> , Thank you
                                            </td>
                                        </tr>
                                        <td class="text-right text-info">
                                            <h5><b>Updat donate date :</b></h5>
                                        </td>
                                        <td colspan="5"><b>
                                                <input class="form-control" date-format="yyyy-mm-dd" value="{{$id}}"
                                                    placeholder="YYYY-MM-DD" size="" type="hidden" name="donor_id">
                                                <input class="form-control" date-format="yyyy-mm-dd" value="yyyy-mm-dd"
                                                    placeholder="YYYY-MM-DD" size="" type="date" value="" name="u_dod">
                                            </b></td>

                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <a class="btn btn-info pull-left" href="{{ route('admin.donate.create') }}"><b><i
                                                            class="fa fa-reply-all"></i> Back</b></a>
                                                <button type="submit" class="btn pull-right btn-info"><b><i
                                                            class="fa fa-arrow-circle-right"></i> Update</b></button>
                                            </td>
                                        </tr>
                                    </form>
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            You donated blood on date: <span class="text-info">{{$donate->dod}}</span> ,
                                            Thank you. <br>
                                            Next time you have to wait 3 months at least for donating blood.
                                        </td>
                                    </tr>
                                    @endif



                                    @endif


                                    @else
                                    <form action="" method="get">
                                        @csrf
                                        <tr>
                                            <td class="text-right text-info">
                                                <h5><b>Donor list :</b></h5>
                                            </td>
                                            <td colspan="">
                                                <b>
                                                    <select class="form-control chosen" name="d_id" required="" >
                                                        <option value="">Select donor!</option>
                                                        @foreach ($donor_list as $donor)
                                                        <option value="{{$donor->id}}">{{$donor->name}} |
                                                            {{$donor->phone}}</option>
                                                        @endforeach
                                                    </select>
                                                </b>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <a class="btn btn-info pull-left" href="{{ route('admin') }}"><b><i
                                                            class="fa fa-reply-all"></i> Back</b></a>
                                                <button type="submit" class="btn pull-right btn-info"><b><i
                                                            class="fa fa-arrow-circle-right"></i> Add Donate</b></button>
                                            </td>
                                        </tr>

                                    </form>
                                    @endif



                                </thead>
                                <tfoot>
                                    <tr class="btn-info text-center">
                                        <td colspan="6"><b></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
      $(".chosen").chosen();
</script>

        <!-- End Form Elements -->
    </div>
</div>

@endsection