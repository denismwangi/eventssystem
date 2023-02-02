<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Booking;
use Validator;
use App\Ticket;
use App\Payment;
use Redirect;

class BookingsController extends Controller
{

	public function index()
	{
		$bookings = Booking::orderBy('created_at', 'DESC')->get();

		return view('admin.bookings.index', compact('bookings'));
	}

	public function approve($id)
	{

		$ok = Payment::where('id', $id)->update([
			'status' => 1,
		]);
		if ($ok) {
			return redirect::back()->with('success', 'Payment approved successfully');
		}else{
			return redirect::back()->with('error', 'Failed saomething went wrong');
		}

	}


}