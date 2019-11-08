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


<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var options = {
	animationEnabled: true,
	title: {
		text: "Blood group rate"
	},
	axisY: {
		title: "Donor rate",
		suffix: "%",
		includeZero: false
	},
	axisX: {
		title: "Blood Group"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.0#"%"",
		dataPoints: [
            @php
    $Blood_group = App\Models\Blood_group::orderBy('id')->get();
    @endphp
@foreach ($Blood_group as $bgroup)
{ y:{{ $bgroup->count }} , label: "{{ $bgroup->count }}", indexLabel: "{{ $bgroup->bg_name }}" },

@endforeach
		
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>
