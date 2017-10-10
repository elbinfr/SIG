<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sending;
use Carbon\Carbon;

class SentController extends Controller
{
    /**
     * 
     */
    public function sentByCorporates()
    {
    	setBreadCrumb('Mensajes', 'Enviados', 'Envios por supervisor');

    	$start_date = Carbon::now()->day(1)->format('d/m/Y');
    	$end_date = Carbon::now()->format('d/m/Y');

    	return view('message.sent.by-supervisor', compact('start_date', 'end_date'));
    }

    public function getSentByCorporates(Request $request)
    {
        $start_date = stringToDate($request->start_date);
        $end_date = stringToDate($request->end_date);

    	$sendings = Sending::join('corporates', 'corporates.username', '=', 'sendings.corporate_id')
    					->select(
    						\DB::raw('sendings.corporate_id, sum(sendings.sent_messages) as sent_messages'))    					
    					->where('corporates.client_id', '=', client_id())
    					->dateRange([$start_date, $end_date])
    					->groupBy('sendings.corporate_id')
    					->orderBy('sent_messages', 'DESC')
                     	->get();

        return response()->json([
                    'status'    => 200,
                    'data'   => $sendings
                ]);
    }

}
