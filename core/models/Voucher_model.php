<?php

defined('_EXEC') or die;

class Voucher_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_booking($token)
	{
		$query = $this->database->select('bookings', [
			'[>]tours' => [
				'id_tour' => 'id_tour'
			],
		], [
			'bookings.id_tour',
			'bookings.token',
			'bookings.name',
			'bookings.email',
			'bookings.cellphone',
			'bookings.id_tour',
			'tours.name(tour_name)',
			'tours.cover(tour_cover)',
			'bookings.date_booking',
			'bookings.observations',
			'bookings.paxes',
			'bookings.totals',
			'bookings.payment',
			'bookings.language',
			'bookings.date_booked',
			'bookings.code',
		], [
            'bookings.token' => $token
        ]);

		return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
}
