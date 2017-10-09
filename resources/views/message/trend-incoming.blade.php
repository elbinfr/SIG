
@extends('layouts.master')

@section('main')
    <div class="row-fluid">

        <div class="span12">
            <div id="container" style="width:100%; height: 400px; margin: 0 auto"></div>

        </div>

    </div>
@endsection

@section('script')


    <script type="text/javascript">


        $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
            // Create the chart
            Highcharts.stockChart('container', {


                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'Tendencia de respuestas positivas'
                },

                series: [{
                    name: 'AAPL',
                    data: data,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });

    </script>
@endsection