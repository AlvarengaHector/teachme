<?php namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository {

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
	
	public function paginateLatest()
	{
		return $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->paginate(20);
	}

	public function paginateOpen()
	{
		return $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->where('status','open')
			->paginate(20);
	}

	public function paginateClosed()
	{
		return $this->selectTicketsList()
			->orderBy('created_at', 'DESC')
			->where('status','closed')
			->paginate(20);
	}

	public function findOrFail($id)
	{
		return Ticket::findOrFail($id);
	}

}