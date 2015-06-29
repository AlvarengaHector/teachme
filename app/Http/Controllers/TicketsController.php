<?php namespace TeachMe\Http\Controllers;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TicketsController extends Controller {

	protected function selectTicketsList()
	{

		/*
		
			SELECT
			    t.*,
			    ( SELECT COUNT(*) FROM ticket_comments c WHERE c.ticket_id = t.id ) as num_comments,
			    ( SELECT COUNT(*) FROM ticket_votes v WHERE v.ticket_id = t.id ) as num_votes
			FROM `tickets` t
			WHERE 1

		*/

		return Ticket::selectRaw(
			'tickets.*, '
			. '( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id ) as num_comments,'
			. '( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id ) as num_votes'
		)->with('author'); // eager loading
	}

	public function latest()
	{

		$tickets = $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->paginate(20);

		return view('tickets.list', compact('tickets'));
	}

	public function popular()
	{
		return view('tickets.list');
	}

	public function open()
	{
		$tickets = $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->where('status','open')
			->paginate(20);

		return view('tickets.list', compact('tickets'));
	}

	public function closed()
	{
		$tickets = $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->where('status','closed')
			->paginate(20);

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
		return view('tickets/create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|max:120'
		]);

		// Very important the 'protected $fillable' in the Model

		$ticket = \Auth::user()->tickets()->create([
			'title'		=> $request->get('title'),
			'status'	=> 'open'
		]);

		/*$ticket = new Ticket();
		$ticket->title = $request->get('title');
		$ticket->status = 'open';
		$ticket->user_id = \Auth::user()->id;
		$ticket->save();*/

		return redirect()->route('tickets.details', $ticket->id);
	}

}
