@php use Illuminate\Support\Facades\Hash; @endphp

@extends('backend.b_mastering.master')

@section ('content')
@php $chart_data=""  @endphp
@php $bg_name=""  @endphp
@php $count=""  @endphp
  @php
    $Blood_group = App\Models\Blood_group::orderBy('id')->get();
    @endphp
@foreach ($Blood_group as $bgroup)
@php $chart_data .= "{ bg_name = $bgroup->bg_name , count=$bgroup->count}"; @endphp

@endforeach
@php $chart_data = substr($chart_data, 0, -2); @endphp

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Blood Donor Ratio"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
            @php
    $Blood_group = App\Models\Blood_group::orderBy('id')->get();
    @endphp
@foreach ($Blood_group as $bgroup)
{ y:{{ $bgroup->count }} , name: "{{ $bgroup->bg_name }}", exploded: true },

@endforeach
		
		]

        
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>

                        @php $Donor=""@endphp
                        <div class="row">
                    <div class="col-md-12">
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                      
                    </div>
                </div>
                       
                        <div class="row">
                            <div class="col-md-12 text-center">
                                     @php
                                    $getinput = Input::get('donor')
                                    @endphp
                                    @if($getinput)
                                    @php $donor = App\Models\Donor::Where('d_user_id', $getinput)
                                    ->orWhere('phone', $getinput)
                                    ->first(); 
                                   
                                    @endphp
                         
                       @if(is_null($donor))
                      
                       <div class="col-md-12 text-center">
                            <div class="text-box" >
                                <span class="main-text text-danger">Donor is not found</span>
                                <br>
                                <a href="{{ route("admin") }}">Search again!</a>
                            </div>
                        </div>
                       @else
                        <div class="panel-info btn-default">
                            <div class="panel-heading main-text">SEARCHED DONOR</div>
                            <div class="panel-body">
                               
                        <div class="col-md-12 text-center">
                            <div class="text-box" >
                               <table class="table table-condensed table-bordered table-hover">
                                   <thead>
                                       <tr class="btn-info">
                                          <td>DonorID</td>
                                           <td>Name</td>
                                           <td>Phone</td>
                                           <td>Blood group</td>
                                           <td>Action</td>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           @php  $bg = App\Models\Blood_group::where('id', $donor->blood_group_id)->first() @endphp
                                           <td>{{ $donor->d_user_id }}</td>
                                           <td>{{ $donor->name }}</td>
                                           <td>{{ $donor->phone }}</td>
                                           <td>{{ $bg->bg_name }}</td>
                                           <td><a href="{{ route ('admin.donor.details', $donor->id) }}"class="btn btn-info btn-xs"><i class="fas fa-arrow-alt-circle-right"></i> Details</a></td>
                                       </tr>
                                   </tbody>
                               </table>
                              
                                <a href="{{ route("admin") }}">Search another!</a>
                            </div>
                        </div>
                            </div>
                            <div class="panel-footer "></div>
                        </div>
                       @endif
                        @else
                        
                        <div class="panel-info btn-default">
                             
                            <div class="panel-heading main-text">SEARCH DONOR</div>
                            <div class="panel-body">
                               
                        <div class="col-md-4 text-right">
                            <div class="text-box" >
                               
                                <span class="main-text text-info">Donor ID/Phone</span>
                            </div>
                        </div>
                        <form action="" method="get">
                            @csrf
                            <div class="col-md-6 ">
                                <div class="form-group input-group">
                                        <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                    <input type="text" name="donor" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-example-int">
                                    <button class="btn btn-success  btn-info"><b>SEARCH</b></button>
                                </div>
                            </div>
                            </form>
                        <div class="col-md-1"></div>
                            </div>
                            <div class="panel-footer "></div>
                        </div>
                        @endif
                    </div>
               
                </div>
                
              
@endsection
