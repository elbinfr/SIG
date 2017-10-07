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
                    var series_pie = [];
					var colors = [];
                    var last_color = '';

                    var index = 0;
					$.each(data, function(i,item){
						categories.push(getCobName(data[i].corporate_id));
                        series_pie.push(parseInt(data[i].sent_messages));
                        var color_item = list_colors[i];//getColor(index);
                        console.log(color_item);
                        colors.push(color_item);

						series.push(
                            {
                                y: parseInt(data[i].sent_messages),
                                color: color_item
                            }
                        );

                        last_color = color_item;
                        index++;
					});

					createGrafic(categories, series, series_pie, colors);
				});
			}

			function createGrafic(categories, series, series_pie, colors){

                Highcharts.chart('graphic-bar', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Envios por supervisor'
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
                    legend: {
                        enabled: false
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

                var data_pie = generateDataGraphicPie(categories, series_pie, colors);

                Highcharts.chart('graphic-pie', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Envios por supervisor (%)'
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Cantidad SMS',
                        colorByPoint: false,
                        data: data_pie
                    }]
                });

			}

			getData();

		});
	</script>
@endsection