<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VotesController extends Controller {

	public function submit($id)
	{
		dd("votando por el ticket: " . $id);
	}

	public function destroy($id)
	{
		dd("quitando voto al ticket: " . $id);
	}

}
