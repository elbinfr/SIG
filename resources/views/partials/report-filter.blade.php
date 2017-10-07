<?php $a_mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto' , 'Setiembre' , 'Octubre', 'Noviembre', 'Diciembre'];?>
{!! Form::open(['url' => $url,
                'method' => $method,
                'files' => 'true',
                'data-parsley-validate' => '',
                'class' => 'frmilter well'
            ]) !!}

        <fieldset>
            <p class="f_legend">Buscar por</p>
            <div class="formSep">
                <div class="controls span6">
                    {!! Form::radio('rbFiltro', 'M', ['checked' => 'true'], ['class'=> 'chkb']); !!} Mes
                </div>
                <div class="controls span6">
                    {!! Form::radio('rbFiltro', 'R', null,['class'=> 'chkb']); !!} Rango
                </div><br>
            </div>
            <div class="control-group smonth" >
                {{ Form::select('number', $a_mes,
                                    date('m') - 1, ['class' => 'span12 cbMonth']) }}
            </div>
            <div class="control-group hidden sdate">
                {!! Form::label('from', 'De') !!}
                {!! Form::date('name', \Carbon\Carbon::now(), ['class' => 'span12 from']) !!}
            </div>
            <div class="control-group hidden sdate">
                {!! Form::label('to', 'A') !!}
                {!! Form::date('name', \Carbon\Carbon::now(), ['class' => 'span12 to']) !!}
            </div>
            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-info" type="submit">Mostrar</button>
                </div>
            </div>
        </fieldset>

{!! Form::close() !!}

