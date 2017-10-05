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
    	setBreadCrumb('Mensajes','Recibidos');
    	return view("message.report-incoming");
    }

    public function showTotalIncoming(){

		return ReportIncoming::join('corporates', 'corporates.username', 'ilike', 'node')
								->select(\DB::raw('node, sum(respuestas) as total, sum(positivos) as positivos'))
								->where('corporates.client_id', client_id())
								->where('respuestas','>',0)
								->whereMonth('fecha', '=', date('m'))
								->groupBy('node')->orderBy('total','desc')->orderBy('positivos','desc')->get();

    }

}
