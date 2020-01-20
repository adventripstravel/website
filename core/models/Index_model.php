<?php

defined('_EXEC') or die;

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_main_tour()
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
			'tours.priority' => 1
		]);

		return !empty($query) ? Functions::get_array_json_decoded($query[0]) : null;
	}

	public function get_tours()
	{
		$query1 = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.name',
			'tours.summary',
			'tours.price',
			'tours.cover',
			'destinations.name(destination)',
			'tours.priority'
		], [
			'tours.priority[>=]' => 2,
			'ORDER' => [
				'tours.priority' => 'ASC'
			]
		]);

		$query2 = $this->database->select('tours', [
			'[>]destinations' => [
				'destination' => 'id'
			]
		], [
			'tours.id',
			'tours.name',
			'tours.summary',
			'tours.price',
			'tours.cover',
			'destinations.name(destination)',
			'tours.priority'
		], [
			'tours.priority[=]' => null,
			'ORDER' => [
				'tours.name' => 'ASC'
			]
		]);

		return Functions::get_array_json_decoded(array_merge($query1, $query2));
	}

	public function check_exist_voucher($token)
	{
		$query = $this->database->count('bookings', [
			'token' => $token
		]);

		return ($query >= 1) ? true : false;
	}
}
