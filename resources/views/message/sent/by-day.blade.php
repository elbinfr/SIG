@extends('layouts.master')

@section('main')
    <div class="row-fluid">
        <div class="span12">
            <div id="graphic-line" style="min-height: 400px;">
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#graphic-line').loading();
        $.getJSON('{{url('/message/get-data-by-day')}}', function (data) {
            // Create the chart
            Highcharts.stockChart('graphic-line', {
                rangeSelector: {
                    selected: 1
                },
                title: {
                    text: 'Envios por día'
                },
                series: [{
                    name: 'AAPL',
                    data: data,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
            $('#graphic-line').loading('stop');
        });
    </script>
@endsection