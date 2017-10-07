<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sending;
use Carbon\Carbon;
use HighCharts;

class SentController extends Controller
{
    /**
     * 
     */
    public function sentByCorporates()
    {
    	setBreadCrumb('Mensajes', 'Enviados');

    	return view('message.sent');
    }

    public function getSentByCorporates()
    {
    	$sendings = Sending::join('corporates', 'corporates.username', '=', 'sendings.corporate_id')
    					->select(
    						\DB::raw('sendings.corporate_id, sum(sendings.sent_messages) as sent_messages'))    					
    					->where('corporates.client_id', '=', client_id())
    					->dateRange(['2017-09-01', '2017-09-30'])
    					->groupBy('sendings.corporate_id')
    					->orderBy('sent_messages', 'DESC')
                     	->get();

        return response()->json([
                    'status'    => 200,
                    'data'   => $sendings
                ]);
    }
}
