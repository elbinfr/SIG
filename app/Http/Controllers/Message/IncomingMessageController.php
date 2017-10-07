<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IncomingMessage;
use App\ReportIncoming;

class IncomingMessageController extends Controller
{
    //

    public function index(){
    	setBreadCrumb('Mensajes','Recibidos', 'SMS Recibidos vs Positivos');
    	return view("message.report-incoming");
    }

    public function trend(){
        setBreadCrumb('Mensajes','Recibidos', 'Tendencia de respuestas positivas');
        return view("message.trend-incoming");
    }

    public function showTotalIncoming(Request $request){
        $filter = $request->filter;
        $month = intval($request->month) + 1;
        $from = $request->from;
        $to = $request->to;

        $query = ReportIncoming::join('corporates', 'corporates.username', 'ilike', 'node')
            ->select(\DB::raw('node, sum(respuestas) as total, sum(positivos) as positivos'))
            ->where('corporates.client_id', client_id())
            ->where('respuestas','>',0);

        if($filter == 'M'){
            $query = $query->whereMonth('fecha', '=', $month)
                ->groupBy('node')->orderBy('total','desc')->orderBy('positivos','desc')->get();
        }else{
            $query = $query->whereBetween('fecha', [$from, $to])
                ->groupBy('node')->orderBy('total','desc')->orderBy('positivos','desc')->get();
        }

		return $query;

    }

}
