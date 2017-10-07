<li>
    <a href="{{ url('/home') }}" class="ext_disabled"><i class="icon-book icon-white"></i>Dashboard</a>
</li>
<li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Mensajes <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{url('/message/sent')}}" class="ext_disabled">Enviados</a></li>
        <li class="dropdown">
            <a href="#">Recibidos <b class="caret-right"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{url('/message/incoming_message')}}" class="ext_disabled">SMS Recibidos vs Positivos</a></li>
                <li><a href="{{url('/message/trend')}}" class="ext_disabled">Tendencia de respuestas positivas</a></li>
            </ul>
        </li>
    </ul>
</li>