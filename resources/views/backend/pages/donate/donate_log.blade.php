@extends('backend.b_mastering.master')
@section ('content')
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default btn-default">
                        <div class="panel-heading">
                            <h2><b><i class="fa fa-list"></i> Blood donate history </b>
                            @include('backend.partials.message')
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="x_content">
                                        <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover text-center" id="d_table">
                                            <thead>
                                                <tr class="btn-info text-center">
                                                    <td><b>Sl#</b></td>
                                                    <td><b>DonorId</b></td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Blood group</b></td>
                                                    <td ><b>Donate date</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Blood_donate_log as $bdl)
                                                @php
                                                 $donor = App\Models\Donor::Where('id', $bdl->d_id)->first();
                                                 $Blood_group = App\Models\Blood_group::Where('id', $donor->blood_group_id)->first();
                                                @endphp
                                               <tr>
                                               <td>{{ $loop->index+1 }}</td>
                                               <td>{{$donor->d_user_id}}</td>
                                               <td>{{$donor->name}}</td>
                                               <td>{{$Blood_group->bg_name}}</td>
                                               <td>{{$bdl->dod}}</td>
        

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
