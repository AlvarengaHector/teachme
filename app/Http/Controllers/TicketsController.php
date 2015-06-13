<?php namespace TeachMe\Http\Controllers;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TicketsController extends Controller {

	public function latest()
	{
		$tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);

		return view('tickets.list', compact('tickets'));
	}

	public function popular()
	{
		return view('tickets.list');
	}

	public function open()
	{
		$tickets = Ticket::orderBy('created_at', 'DESC')->where('status','open')->paginate(20);

		return view('tickets.list', compact('tickets'));
	}

	public function closed()
	{
		$tickets = Ticket::orderBy('created_at', 'DESC')->where('status','closed')->paginate(20);

		return view('tickets.list', compact('tickets'));
	}

	public function details($id)
	{
		$ticket = Ticket::findOrFail($id);
		
		/*$comments = TicketComment::select('ticket_comments.*', 'users.name')
			->join('users', 'ticket_comments.user_id', '=', 'users.id')
			->where('ticket_id', $id)
			->paginate();*/

		return view('tickets/details', compact('ticket'));
	}

	public function create()
	{
		return '[Formulario de solicitud]';
	}

}
