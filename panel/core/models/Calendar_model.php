<?php
defined('_EXEC') or die;

class Calendar_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_reservations()
	{
		return $this->database->select('reservations', [
			'folio',
			'origin',
			'data [Object]'
		], [
			'status' => 'available'
		]);
	}

	public function get_tours()
	{
		return $this->database->select('tours', [
			'id',
			'folio',
			'name',
			'data [Object]',
			'status',
		]);
	}

	public function datetime( $date = null )
	{
		Format::set_time_zone();

		if ( is_null($date) )
			$date = 'NOW';

		$datetime = new DateTime($date);
		$response = $datetime->format('c');

		return $response;
	}

}
