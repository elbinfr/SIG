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

        $query = IncomingMessage::select(\DB::raw('corporate_id as node, sum(total) as total, sum(positive) as positivos'))
            ->where('enterprise_id', client_id());

        if($filter == 'M'){
            $query = $query->whereMonth('received_date', '=', $month)
                ->groupBy('corporate_id')->orderBy('total','desc')->orderBy('positivos','desc')->get();
        }else{
            $query = $query->whereBetween('received_date', [$from, $to])
                ->groupBy('node')->orderBy('total','desc')->orderBy('positivos','desc')->get();
        }

		return $query;

    }

}
