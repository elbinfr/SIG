@extends('layouts.master')

@section('main')
<div class="row-fluid">
    <div id="gantt_here" style='width:100%; min-height: 500px;; max-height: 500px;'></div>
</div>
@endsection

@section('script')

    <script type="text/javascript">

        function getData(){
            $('#gantt_here').loading();
            $.get( "{{ url('getSendingToday') }}"
                , function( response ) {

                    createGantt(response);

                });
        }

        function createGantt(response){
            $('#gantt_here').loading("stop");
            gantt.config.columns = [
                {name:"text",       label:"Campaña",  width:"*", tree:true },
                {name:"duration",   label:"Duración (mn)",   align: "center" }
            ];
            gantt.config.xml_date="%Y-%m-%d %H:%i";
            gantt.config.scale_unit = "hour";
            gantt.config.step = 1;
            gantt.config.date_scale = "%g %a";
            gantt.config.min_column_width = 20;
            gantt.config.duration_unit = "minute";
            gantt.config.duration_step = 1;
            gantt.config.scale_height = 75;

            gantt.config.subscales = [
                {unit:"day", step:1, date : "%j %F, %l"},
                {unit:"minute", step:5, date : "%i"}
            ];

            gantt.init("gantt_here");
            gantt.parse({
                "data":response
            });
        }

        getData();


    </script>
@endsection