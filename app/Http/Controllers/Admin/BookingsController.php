<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Booking;
use Validator;
use App\Ticket;
use Redirect;

class BookingsController extends Controller
{

	public function index()
	{
		$bookings = Booking::orderBy('created_at', 'DESC')->get();

		return view('admin.bookings.index', compact('bookings'));
	}


}