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

	public function get_availability($id, $date, $availability)
	{
		$query = Functions::get_decoded_query($this->database->select('bookings', [
			'paxes'
		], [
            'AND' => [
				'id_tour' => $id,
				'date_booking' => $date,
			]
        ]));

		if (!empty($query))
		{
			foreach ($query as $value)
				$availability = $availability - ($value['paxes']['adults'] + $value['paxes']['children']);
		}

		return $availability;
	}

	// public function get_seller($token)
	// {
	// 	$id = null;
	//
	// 	$query = Functions::get_decoded_query($this->database->select('users', [
	// 		'id_user',
	// 	], [
	// 		'token' => $token
	// 	]));
	//
	// 	return $query;
	// }

	/* Inserts
	------------------------------------------------------------------------------- */
	// public function new($data)
	// {
	// 	$query = $this->database->insert('bookings', [
	// 		'token' => $data['payment'][0]['data']['booking']['token'],
	// 		'name' => $data['payment'][0]['data']['booking']['name'],
	// 		'email' => $data['payment'][0]['data']['booking']['email'],
	// 		'cellphone' => $data['payment'][0]['data']['booking']['cellphone'],
	// 		'id_tour' => $data['payment'][0]['data']['booking']['id_tour'],
	// 		'date_booking' => $data['payment'][0]['data']['booking']['date_booking'],
	// 		'observations' => $data['payment'][0]['data']['booking']['observations'],
	// 		'paxes' => json_encode($data['payment'][0]['data']['booking']['paxes']),
	// 		'totals' => json_encode($data['payment'][0]['data']['booking']['totals']),
	// 		'payment' => json_encode($data['payment'][0]['data']['booking']['payment']),
	// 		'language' => $data['payment'][0]['data']['booking']['language'],
	// 		'canceled' => $data['payment'][0]['data']['booking']['canceled'],
	// 		'date_booked' => $data['payment'][0]['data']['booking']['date_booked'],
	// 		'code' => $data['payment'][0]['data']['booking']['code']
	// 	]);
	//
	// 	if (!empty($query))
	// 	{
	// 		$query = $this->database->insert('com_payment_tmp', [
	// 			'incidence_number' => $data['payment'][0]['incidence_number'],
	// 			'data' => json_encode($data)
	// 		]);
	//
	// 		return !empty($query) ? $this->database->id($query) : null;
	// 	}
	// 	else
	// 		return null;
	// }

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
}
