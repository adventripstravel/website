<?php
defined('_EXEC') or die;

class Ticket_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_ticket( $ticket = null )
	{
		$response = $this->database->select('bookings', [
			'folio',
			'customer[Object]',
			'paxes[Object]',
			'observations',
			'data[Object]',
			'tour[Object]',
			'creation_date',
			'status',
			'status_payment'
		], [
			'folio' => $ticket
		]);

		return ( isset($response[0]) && !empty($response[0]) ) ? $response[0] : null;
	}
}
