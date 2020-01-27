<?php

defined('_EXEC') or die;

class Booking_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_tour($id)
	{
		$query = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.type',
			'tours.name',
			'tours.summary',
			'tours.description',
			'tours.schedules',
			'tours.price',
			'tours.cover',
			'tours.gallery',
			'destinations.name(destination)',
			'tours.seo'
		], [
            'tours.id' => $id
        ]);

		return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function get_ladas()
	{
		$query = $this->database->select('ladas', [
			'name',
			'code'
		]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_main_tours($id)
	{
		$query = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.name',
			'tours.summary',
			'tours.price',
			'tours.cover',
			'destinations.name(destination)'
		], [
            'AND' => [
				'tours.id[!]' => $id,
				'tours.priority[>=]' => 1
			],
			'ORDER' => [
				'priority' => 'ASC'
			],
			'LIMIT' => 2
        ]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_total($data)
	{
		return (($data['adults'] * $data['tour']['price']['adult']) + ($data['childs'] * $data['tour']['price']['child']));
	}

	public function new_booking($data)
	{
		$query = $this->database->insert('bookings', [
			'token' => Functions::get_random_string(8),
			'tour' => $data['tour']['id'],
			'paxes' => json_encode([
				'childs' => $data['childs'],
				'adults' => $data['adults'],
			]),
			'booked_date' => $data['date'],
			'observations' => $data['observations'],
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'phone' => json_encode([
				'lada' => $data['phone_lada'],
				'number' => $data['phone_number'],
			]),
			'price' => json_encode([
				'child' => $data['tour']['price']['child'],
				'adult' => $data['tour']['price']['adult'],
			]),
			'total' => $this->get_total($data),
			'payment' => json_encode([
				'status' => false,
				'date' => null,
				'method' => null,
				'currency' => Session::get_value('currency'),
				'exchange' => Functions::get_currency_exchange(1, 'USD', 'MXN')
			]),
			'language' => $data['language'],
			'canceled' => false,
			'request' => json_encode([
				'type' => 'none'
			]),
			'registration_date' => Functions::get_current_date()
		]);

		if (!empty($query))
		{
			$query = $this->database->select('bookings', [
				'token',
				'paxes',
				'booked_date',
				'observations',
				'firstname',
				'lastname',
				'email',
				'phone',
				'total',
				'language'
			], [
				'id' => $this->database->id()
			]);

			return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
		}
		else
			return null;
	}
}