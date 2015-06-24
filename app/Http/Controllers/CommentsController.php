<?php namespace TeachMe\Http\Controllers;

use TeachMe\Entities\TicketComment;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CommentsController extends Controller {

	public function submit(Request $request, $id)
	{
		$this->validate($request, [
			'comment' => 'required|max:250',
			'link'	  => 'url'
		]);
		
		$comment = new TicketComment($request->all());
		$comment->user_id = \Auth::user()->id;

		$ticket = Ticket::findOrFail($id);
		$ticket->comments()->save($comment);

		session()->flash('success', 'Tu comentario fue guardado exitosamente.');

		return redirect()->back();
	}

}
