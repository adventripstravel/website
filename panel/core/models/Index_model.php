<?php
defined('_EXEC') or die;

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_reservations()
	{
		global $reservations;

		$reservations = $this->database->select('bookings', [
			'folio',
			'customer [Object]',
			'paxes [Object]',
			'data [Object]',
			'tour [Object]'
		]);
	}
}
