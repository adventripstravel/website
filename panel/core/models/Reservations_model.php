<?php
defined('_EXEC') or die;

class Reservations_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// GETS
	public function get_reservations_by_folio( $folio = null )
	{
		$response = $this->database->select('bookings', [
			'folio',
			'customer [Object]',
			'paxes [Object]',
			'observations',
			'data [Object]',
			'tour [Object]',
			'creation_date'
		], [
			'folio' => $folio
		]);

		return ( isset($response[0]) && !empty($response[0]) ) ? $response[0] : null;
	}

	// INSERTS

	// UPDATES

}
