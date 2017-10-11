@extends('layouts.master')

@section('main')
    <div class="row-fluid">
        <div class="span12">
            {!! Form::open([
                'url' => 'message/sent-by-corporates',
                'method' => 'POST',
                'class' => 'form-inline well',
                'id' => 'form']) !!}
                <div class="row-fluid">
                    <div class="span2 hidden-phone hidden-tablet">
                        &nbsp;
                    </div>
                    <div class="span3">
                        {!! Form::label('start_date', 'Desde') !!}
                        {!! Form::text('start_date', $start_date, ['class' => 'start_date']) !!}
                    </div>
                    <div class="span3">
                        {!! Form::label('end_date', 'Hasta') !!}
                        {!! Form::text('end_date', $end_date, ['class' => 'end_date']) !!}
                    </div>
                    <div class="span2">
                        <button class="btn btn-info btn-block" type="submit">Mostrar</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row-fluid margin-top-5" id="graphic">
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

            function initEvents(){
                $('#form').on('submit', function(event){
                    event.preventDefault();
                    getData();
                });
            }

            function getData(){
                var parameters = $('#form').serialize();
                $.post( "{{ url('/message/sent-by-corporates') }}", parameters, function( response ) {
                    var data = response.data;
                    var categories = [];
                    var series = [];
                    var series_pie = [];
                    var colors = [];
                    var last_color = '';

                    var index = 0;
                    var total = 0;
                    $.each(data, function(i,item){
                        total = total + parseInt(data[i].sent_messages);
                        categories.push(getCobName(data[i].corporate_id));
                        series_pie.push(parseInt(data[i].sent_messages));
                        var color_item = list_colors[i];
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

                    createGrafic(categories, series, series_pie, colors, total);
                });
            }

            function createGrafic(categories, series, series_pie, colors, total){

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
                        enabled: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'TOTAL DE MENSAJES ENVIADOS: ' + total + ' sms',
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

            $(document).ajaxStart(function() {
                //graphic.show();
                $('#graphic').loading();
            });

            $(document).ajaxStop(function() {
                $('#graphic').loading('stop');
            });

            initEvents();
            getData();

        });
    </script>
@endsection