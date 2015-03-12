<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Realtime Data</title>
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
		<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script>
		var chart; // global
                var json;
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function requestData() {
			$.ajax({
				url: 'data-grafik.php', 
				dataType: 'text',
				success: function(point) {
					json = eval('(' + point + ')');
					$.each(json, function(i, item) {
						x = json[i].x,
						y = json[i].y						
					})	
					var series = chart.series[0];
					series.addPoint([x, y], true, true);					
					setTimeout(requestData, 1000);	
				},
				cache: false
			});
		}		 
	
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'spline',
					events: {
							load: requestData
					}
				},
				title: {
					text: ''
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					minPadding: 0.2,
					maxPadding: 0.2,
					title: {
						text: 'Value',
						margin: 80
					}
				},
				series: [{
					name: 'Realtime Suhu',
                data: (function () {
                    var data = [];
					var json = (function () {
						var json = null;
						$.ajax({
							'async': false,
							'global': false,
							url: 'data-grafik.php',
							'dataType': "text",
							'success': function (data) {
								json = data;
							}
						});
						return json;
					})(); 
					output = eval('(' + json + ')');
					//output = json;
					$.each(output, function(i, item) {
						data.push({
							x: output[i].x,
							y: output[i].y
						});
					})	
                    return data;
                }())
				}]
			});		
		});
		</script>
		
	</head>
	<body>
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
	</body>
</html>
