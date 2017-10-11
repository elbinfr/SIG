@extends('layouts.master')

@section('main')
<div class="row-fluid">

    <div class="span2">
        @include('partials.report-filter', [ 'url' => 'message/reportIncoming' ,
                                             'method' => 'POST'])
    </div>
    <div class="span10">
	<div id="container" style="width:100%; height: 400px; margin: 0 auto"></div>


	</div>

</div>
@endsection

@section('script')

<script type="text/javascript">


        function getData(){
            $('#container').loading();
            filter = $('input:radio[name=rbFiltro]:checked').val();
            month = $(".cbMonth").val();
            from = $(".from").val();
            to = $(".to").val();

            $.get( "{{ url('message/reportIncoming') }}", {filter: filter, month: month, from:from, to:to }
                , function( response ) {
                    var nodes = new Array();
                    var serie1 = new Array();
                    var serie2 = new Array();

                    $.each(response, function(i, item) {
                        nodes.push(item['node']);
                        serie1.push(parseInt(item['total']));
                        serie2.push(parseInt(item['positivos']));
                    });

                    createGrafic(nodes, serie1, serie2);
                });
        }

        function createGrafic(nodes, serie1, serie2){
            $('#container').loading('stop');
            var options = {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'SMS Recibidos vs Positivos'
                },
                subtitle: {
                    text: 'Origen: <a href="http://www.mowa.com.pe/MES/">mowa.com.pe</a>'
                },
                xAxis: {
                    categories: nodes,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Mensajes (unidades)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ' mensajes'
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
                    name: 'Recibidos',
                    data: serie1
                }, {
                    name: 'Positivos',
                    data: serie2
                }]
            };

            Highcharts.chart('container', options);
        }

        getData();




    </script>
@endsection