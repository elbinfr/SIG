<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highstock Example</title>

    <style type="text/css">

    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="{{asset('plugins/Highstock/code/highstock.js')}}"></script>
<script src="{{asset('plugins/Highstock/code/modules/exporting.js')}}"></script>

<div id="container" style="height: 400px; min-width: 310px"></div>


<script type="text/javascript">


    $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
        // Create the chart
        Highcharts.stockChart('container', {


            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'AAPL Stock Price'
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
</body>
</html>
