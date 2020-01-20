<?php

defined('_EXEC') or die;

class Voucher_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_booking($token)
	{
		$query = $this->database->select('bookings', [
			'[>]tours' => [
				'tour' => 'id'
			],
			'[>]destinations' => [
				'tours.destination' => 'id'
			]
		], [
			'bookings.token',
			'tours.name(tour_name)',
			'tours.summary(tour_summary)',
			'tours.cover(tour_cover)',
			'destinations.name(tour_destination)',
			'bookings.paxes',
			'bookings.booked_date',
			'bookings.observations',
			'bookings.firstname',
			'bookings.lastname',
			'bookings.email',
			'bookings.phone',
			'bookings.total',
			'bookings.payment',
			'bookings.language',
			'bookings.canceled',
			'bookings.registration_date',
		], [
            'bookings.token' => $token
        ]);

		return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function new_request($data)
	{
		$query = $this->database->update('bookings', [
			'request' => $data['request']
		], [
			'token' => $data['booking']['token']
		]);

		return $query;
	}
}
