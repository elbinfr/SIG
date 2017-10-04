@extends('layouts.master')

@section('main')
	<div class="row-fluid">
		<div class="span12">
			<div id="graphic" >
			</div>
		</div>    	
	</div>
@endsection

@section('script')

	<script>
		$(function () {

			function getData(){
				$.get( "{{ url('/message/sent-by-corporates') }}", function( response ) {
					var data = response.data;
					var categories = new Array();
					var series = new Array();

					$.each(data, function(i,item){
						categories.push(data[i].corporate_id);
						series.push(parseInt(data[i].sent_messages));
					});

					createGrafic(categories, series);
				});
			}

			function createGrafic(categories, series){
				Highcharts.setOptions({
    				colors: ['#058DC7', '#50B432', '#ED561B', 
    						'#DDDF00', '#24CBE5', '#64E572', 
    						'#FF9655', '#FFF263', '#6AF9C4']
				});
				
				Highcharts.chart('graphic', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: 'Total de Mensajes Enviados Por Cobs'
				    },
				    xAxis: {
				        categories: categories,
				        crosshair: true
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: 'Total Mensajes Enviados'
				        }
				    },
				    tooltip: {
				        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				            '<td style="padding:0"><b>{point.y:.1f} sms</b></td></tr>',
				        footerFormat: '</table>',
				        shared: true,
				        useHTML: true
				    },
				    plotOptions: {
				        column: {
				            pointPadding: 0.2,
				            borderWidth: 0
				        }
				    },
				    series: [{
				        name: 'Cantidad de Mensajes',
				        data: series
				    }]
				});
				
			}

			getData();

		});
	</script>
@endsection