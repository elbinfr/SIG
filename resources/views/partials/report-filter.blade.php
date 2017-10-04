<?php $a_mes = ['Enero', 'Febrero', 'Marzo', 'Abriil', 'Mayo', 'Junio', 'Julio', 'Agosto' , 'Setiembre' , 'Octubre', 'Noviembre', 'Diciembre'];?>
{!! Form::open(['url' => $url,
                'method' => $method,
                'files' => 'true',
                'data-parsley-validate' => '',
                'class' => 'well'
            ]) !!}

        <fieldset>
            <p class="f_legend">Buscar por</p>
            <div class="formSep">
                <div class="controls span6">
                    {!! Form::radio('rbFiltro', 'M', ['checked' => 'true'], ['onClick'=> 'prueba()']); !!} Mes
                </div>
                <div class="controls span6">
                    {!! Form::radio('rbFiltro', 'R'); !!} Rango
                </div><br>
            </div>
            <div class="control-group" >
                {{ Form::select('number', $a_mes,
                                    date('m') - 1, ['class' => 'span12']) }}
            </div>
            <div class="control-group hidden">
                {!! Form::label('description', 'De') !!}
                {!! Form::date('name', \Carbon\Carbon::now(), ['class' => 'span12']) !!}
            </div>
            <div class="control-group hidden">
                {!! Form::label('description', 'A') !!}
                {!! Form::date('name', \Carbon\Carbon::now(), ['class' => 'span12']) !!}
            </div>
            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-info" type="submit">Mostrar</button>
                </div>
            </div>
        </fieldset>

{!! Form::close() !!}

