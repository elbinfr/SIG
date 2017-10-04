@extends('layouts.master')

@section('main')

<div class="row-fluid">

	<div class="span11 offset1">
	<div id="container" style="width:100%; height: 400px; margin: 0 auto"></div>

        
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
        var options = {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Reporte de mensajes recibidos'
            },
            subtitle: {
                text: 'Origen: <a href="http://www.mowa.com.pe/MES/">mowa.com.pe</a>'
            },
            xAxis: {
                categories: [],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' millions'
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
                data: []
            }, {
                name: 'Positivos',
                data: []
            }]
        };
    
    
   
    var nodes = new Array();
    var serie1 = new Array();
    var serie2 = new Array();

    $.ajax({'async': false,
            'global': false,
            'url': "{{url('message/reportIncoming')}}",
            'dataType': "json",
            'success': function (data) {
                console.log(data);
                $.each(data, function(i, item) {
                    nodes.push(item['node']);
                    serie1.push(parseInt(item['total']));
                    serie2.push(parseInt(item['positivos']));
                });
                
        }
    });
        options.xAxis.categories =  nodes;
        options.series[0].data =  serie1;
        options.series[1].data = serie2;
        Highcharts.chart('container', options);

    
        </script>
@endsection