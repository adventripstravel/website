<?php

defined('_EXEC') or die;

class Booking_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_tour( $url = null )
	{
		if ( is_null($url) )
			return false;

		$query = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.url',
			'tours.name [JSON]',
			'tours.summary [JSON]',
			'tours.description [JSON]',
			'tours.schedules [JSON]',
			'tours.price [JSON]',
			'tours.cover',
			'tours.gallery [JSON]',
			'destinations.name (destination)',
			'tours.seo [JSON]',
			'tours.available'
		], [
            'tours.url' => $url
        ]);

		return ( isset($query[0]) ) ? $query[0] : null;

		// return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function get_phone_ladas()
	{
		$query = $this->database->select('phone_ladas', [
			'name',
			'code'
		]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_main_tours($url)
	{
		$query = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.url',
			'tours.name',
			'tours.summary',
			'tours.price',
			'tours.cover',
			'destinations.name(destination)',
			'tours.available'
		], [
            'AND' => [
				'tours.url[!]' => $url,
				'tours.priority[>=]' => 1
			],
			'ORDER' => [
				'priority' => 'ASC'
			],
			'LIMIT' => 2
        ]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_price($data, $type = 'foreign')
	{
		if ($data['type'] == 'regular')
		{
			if ($type == 'foreign')
			{
				if ($data['discounts']['foreign']['amount'] > 0)
				{
					$data['discounts']['foreign']['amount'] = $data['discounts']['foreign']['amount'] / 100;
					$data['public']['childs'] = $data['public']['childs'] - ($data['public']['childs'] * $data['discounts']['foreign']['amount']);
					$data['public']['adults'] = $data['public']['adults'] - ($data['public']['adults'] * $data['discounts']['foreign']['amount']);
				}
			}
		}
		else if ($data['type'] == 'height')
		{
			if ($type == 'foreign')
			{
				if ($data['discounts']['foreign']['amount'] > 0)
				{
					$data['discounts']['foreign']['amount'] = $data['discounts']['foreign']['amount'] / 100;
					$data['public']['min'] = $data['public']['min'] - ($data['public']['min'] * $data['discounts']['foreign']['amount']);
					$data['public']['max'] = $data['public']['max'] - ($data['public']['max'] * $data['discounts']['foreign']['amount']);
				}
			}
		}

		return $data['public'];
	}

	public function get_total($data)
	{
		print_r($data);
		// return (($data['childs'] * $data['tour']['price']['child']) + ($data['adults'] * $data['tour']['price']['adult']));
	}

	public function create_booking($data = null)
	{
		if ( is_null($data) )
			return null;

		$tour = $data['tour'];
		unset($data['tour']);

		$this->database->insert('bookings', [
			'folio' => strtoupper(Functions::get_random_string(8)),
			'customer' => $data['customer'],
			'paxes' => $data['paxes'],
			'observations' => $data['observations'],
			'data' => $data,
			'tour' => $tour,
			'creation_date' => date('Y-m-d H:i:s')
		]);


		return $this->database->id();

		// $query = $this->database->insert('bookings', [
		// 	'token' => Functions::get_random_string(8),
		// 	'tour' => $data['tour']['id'],
		// 	'paxes' => $data['total_paxes'],
		// 	'booked_date' => $data['date'],
		// 	'observations' => $data['observations'],
		// 	'firstname' => $data['firstname'],
		// 	'lastname' => $data['lastname'],
		// 	'email' => $data['email'],
		// 	'phone' => json_encode([
		// 		'lada' => $data['phone_lada'],
		// 		'number' => $data['phone_number']
		// 	]),
		// 	'total' => $data['total'],
		// 	'payment' => json_encode([
		// 		'status' => false,
		// 		'date' => null,
		// 		'method' => null,
		// 		'currency' => Session::get_value('currency'),
		// 		'exchange' => Functions::get_currency_exchange(1, 'USD', 'MXN')
		// 	]),
		// 	'language' => $data['language'],
		// 	'canceled' => false,
		// 	'request' => json_encode([
		// 		'type' => 'none'
		// 	]),
		// 	'registration_date' => Functions::get_current_date()
		// ]);
		//
		// if (!empty($query))
		// {
		// 	$query = $this->database->select('bookings', [
		// 		'token',
		// 		'paxes',
		// 		'booked_date',
		// 		'observations',
		// 		'firstname',
		// 		'lastname',
		// 		'email',
		// 		'phone',
		// 		'total',
		// 		'language'
		// 	], [
		// 		'id' => $this->database->id()
		// 	]);
		//
		// 	return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
		// }
		// else
		// 	return null;
	}
}
