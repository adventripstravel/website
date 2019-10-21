<?php

defined('_EXEC') or die;

class Booking_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_tour($id)
	{
		$query = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.name',
			'tours.description',
			'tours.observations',
			'tours.price',
			'tours.discount',
			'tours.availability',
			'tours.cover',
			'tours.gallery',
			'tours.location',
			'tours.transportation',
			'destinations.name(destination)',
		], [
            'tours.id' => $id
        ]);

		return !empty($query) ? Functions::get_decoded_query($query[0]) : null;
	}

	public function get_availability($tour, $date, $availability)
	{
		$query = $this->database->select('bookings', [
			'paxes'
		], [
            'AND' => [
				'tour' => $tour,
				'date_booking' => $date,
			]
        ]);

		if (!empty($query))
		{
			$query = Functions::get_decoded_query($query);

			foreach ($query as $value)
				$availability = $availability - ($value['paxes']['adults'] + $value['paxes']['children']);
		}

		return $availability;
	}

	public function get_ladas()
	{
		$query = $this->database->select('countries', [
			'name',
			'lada'
		]);

		return Functions::get_decoded_query($query);
	}

	public function check_exist_promotional_code($token)
	{
		$query = $this->database->count('users', [
			'token' => $token
		]);

		return !empty($query) ? true : false;
	}

	/* Inserts
	------------------------------------------------------------------------------- */
	public function new($data)
	{
		$query = $this->database->insert('bookings', [
			'token' => $data['booking']['token'],
			'tour' => $data['booking']['tour'],
			'date_booking' => $data['booking']['date_booking'],
			'date_booked' => $data['booking']['date_booked'],
			'paxes' => json_encode($data['booking']['paxes']),
			'firstname' => $data['booking']['firstname'],
			'lastname' => $data['booking']['lastname'],
			'email' => $data['booking']['email'],
			'phone' => $data['booking']['phone'],
			'totals' => json_encode($data['booking']['totals']),
			'payment' => json_encode($data['booking']['payment']),
			'language' => $data['booking']['language'],
			'canceled' => $data['booking']['canceled'],
			'user' => $data['booking']['user'],
		]);

		if (!empty($query))
		{
			$query = $this->database->insert('com_payment_tmp', [
				'incidence_number' => $data['payment']['incidence_number'],
				'data' => json_encode($data)
			]);

			return !empty($query) ? $this->database->id($query) : null;
		}
		else
			return null;
	}

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
}
