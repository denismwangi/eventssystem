<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use Validator;
use App\Ticket;
use Redirect;

class BookingController extends Controller
{
    //
    //
    public function postBook(Request $request)
    {

    	$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'amount' => 'required',
			
		]);
		$booking = new Booking;
		$eid = $request->event_id;
		$booking->event_id = $eid;
		$tid = $request->ticket_id;
		$booking->ticket_id = $tid;
		$booking->amount = $request->amount;
		$booking->name = $request->name;
		$booking->email = $request->email;
		$phone = $request->phone;
		$booking->phone = $phone;

		$booked = Booking::where('event_id', $eid)->where('phone', $phone)->first();
		if($booked){

			return redirect::back()->with('error', 'You have already booked for this event!!');
		}else{

			$booking->save();
			$ticket = Ticket::where('id', $tid)->first();
			$t_amount = $ticket->amount;
			$t_amount1 = $t_amount - 1;
			$update = Ticket::where('id', $tid)->update(['amount' => $t_amount1]);
			return redirect::back()->with('success', 'You have booked for this event successfully');

		}
        
    }
}
