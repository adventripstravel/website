<?php

defined('_EXEC') or die;

class Bookings_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_bookings()
	{
		$query = $this->database->select('bookings', [
			'[>]tours' => [
				'tour' => 'id'
			]
		], [
			'bookings.id',
			'bookings.token',
			'tours.name(tour)',
			'bookings.paxes',
			'bookings.booked_date',
			'bookings.firstname',
			'bookings.lastname',
			'bookings.email',
			'bookings.phone',
			'bookings.total',
			'bookings.payment',
			'bookings.canceled',
			'bookings.request'
		]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_booking($id)
	{
		$query = $this->database->select('bookings', [
			'id',
			'token',
			'tour',
			'paxes',
			'booked_date',
			'observations',
			'firstname',
			'lastname',
			'email',
			'phone',
			'price',
			'total',
			'payment',
			'language',
			'canceled',
			'request',
			'registration_date'
		], [
			'id' => $id
		]);

		return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function get_tours()
	{
		$query = $this->database->select('tours', [
			'id',
			'name'
		]);

		return Functions::get_array_json_decoded($query);
	}

	public function get_tour($id)
	{
		$query = $this->database->select('tours', [
			'id',
			'price'
		], [
			'id' => $id
		]);

		return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function get_total($data)
	{
		$tour = $this->get_tour($data['tour']);

		return (($data['paxes_childs'] * $tour['price']['child']) + ($data['paxes_adults'] * $tour['price']['adult']));
	}

	public function get_phone_ladas()
	{
		$query = $this->database->select('phone_ladas', [
			'name',
			'code'
		]);

		return Functions::get_array_json_decoded($query);
	}

	public function create_booking($data)
	{
		$data['tour'] = $this->get_tour($data['tour']);

		$query = $this->database->insert('bookings', [
			'token' => Functions::get_random_string(),
			'tour' => $data['tour']['id'],
			'paxes' => json_encode([
				'childs' => $data['paxes_childs'],
				'adults' => $data['paxes_adults']
			]),
			'booked_date' => $data['booked_date'],
			'observations' => !empty($data['observations']) ? $data['observations'] : null,
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'phone' => json_encode([
				'lada' => $data['phone_lada'],
				'number' => $data['phone_number']
			]),
			'price' => json_encode([
				'child' => $data['tour']['price']['child'],
				'adult' => $data['tour']['price']['adult']
			]),
			'total' => $data['total'],
			'payment' => json_encode([
				'status' => !empty($data['payment_status']) ? true : false,
				'date' => !empty($data['payment_date']) ? $data['payment_date'] : null,
				'method' => !empty($data['payment_method']) ? $data['payment_method'] : null,
				'currency' => $data['payment_currency'],
				'exchange' => Functions::get_currency_exchange(1, 'USD', 'MXN')
			]),
			'language' => $data['language'],
			'canceled' => !empty($data['canceled']) ? true : false,
			'request' => json_encode([
				'type' => 'none'
			]),
			'registration_date' => Functions::get_current_date()
		]);

		return $query;
	}
}
