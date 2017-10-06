@extends('layouts.master')

@section('main')
	<div class="row-fluid">
		<div class="span7">
			<div id="graphic-bar" >
			</div>
		</div>
        <div class="span5">
            <div id="graphic-pie" >
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
					var categories = [];
					var series = [];

					$.each(data, function(i,item){
						categories.push(data[i].corporate_id);
						series.push(parseInt(data[i].sent_messages));
					});

					createGrafic(categories, series);
				});
			}

			function createGrafic(categories, series){

                Highcharts.chart('graphic-bar', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Total de Mensajes Enviados Por Cobs'
                    },
                    subtitle: {
                        text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
                    },
                    xAxis: {
                        categories: categories,
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad de Mensajes Enviados',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' sms'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Cantidad de Mensajes',
                        data: series
                    }]
                });

                //GRAPHIC PIE
                var data_pie = generateDataGraphicPie(categories, series);
                Highcharts.chart('graphic-pie', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Browser market shares January, 2015 to May, 2015'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Cantidad SMS',
                        colorByPoint: true,
                        data: data_pie
                    }]
                });
				
			}

			getData();

		});
	</script>
@endsection