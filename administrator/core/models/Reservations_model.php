<?php
defined('_EXEC') or die;

class Reservations_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// INSERTS
	public function insert_new_reservation( $data = null ) : bool
	{
		if ( is_null($data) )
			return false;

		$this->database->insert('bookings', $data);

		if ( $this->database->id() )
			return true;
		else
			return false;
	}

	// GETS
	public function get_reservations( $folio = null ) : array
	{
		$_user_level = Session::get_value('_vkye_level');
		$where = [
			'status[!]' => 'removed'
		];

		if ( !is_null($folio) ) $where['folio'] = $folio;

		if ( in_array($_user_level, ['{sales}']) || in_array('{reservations_read_self}', Session::get_value('session_permissions')) )
			$where['__session[~]'] = '%'. Session::get_value('_vkye_user') .'%';

		if ( in_array('{reservations_read}', Session::get_value('session_permissions')) )
		{
			return $this->database->select('bookings', [
				'folio',
				'customer_email',
				'customer_name',
				'status',
				'data [Object]',
				'creation_date',
				'payment_status',
				'__session [Object]'
			], [
				'AND' => $where,
				'ORDER' => [
					'reservation_date' => 'DESC'
				]
			]);
		}
		else return [];
	}











	//
	// public function get_origins_reservations() : array
	// {
	// 	$_user_level = Session::get_value('_vkye_level');
	//
	// 	$response['direct'] = [ 'name' => 'Directo' ];
	// 	$response['courtesy'] = [ 'name' => 'Cortesías' ];
	//
	// 	if ( in_array($_user_level, ['{sysadmin}', '{partner}']) )
	// 		$response['partners'] = [ 'name' => 'Socios' ];
	//
	// 	return $response;
	// }
	//
	// public function get_partners() : array
	// {
	// 	$_user_level = Session::get_value('_vkye_level');
	//
	// 	if ( in_array($_user_level, ['{sysadmin}', '{partner}']) )
	// 	{
	// 		return [
	// 			'roberto_gayol' => [
	// 				'name' => 'Roberto Gayol',
	// 				'email' => 'rgayol@yachtmstr.com',
	// 				'phone' => '9983868622'
	// 			],
	// 			'anastasio_perez' => [
	// 				'name' => 'Anastasio Pérez',
	// 				'email' => '95yesangel@gmail.com',
	// 				'phone' => '9987340956'
	// 			],
	// 		];
	// 	}
	// 	else
	// 	{
	// 		return [];
	// 	}
	// }
	//
	// public function get_boats( $id = null ) : array
	// {
	// 	$where = [
	// 		'hidden' => null,
	// 		'ORDER' => ['ft' => 'ASC']
	// 	];
	//
	// 	if ( !is_null($id) ) $where['id'] = $id;
	//
	// 	return $this->database->select('boats', [
	// 		'id',
	// 		'yacht',
	// 		'name',
	// 		'type',
	// 		'ft',
	// 		'year',
	// 		'passengers',
	// 		'prices [Object]',
	// 		'costs [Object]',
	// 		'hour_extra'
	// 	], $where);
	// }
	//
	// public function get_yacht_data( $id = null ) : array
	// {
	// 	$yacht = $this->get_boats( $id );
	//
	// 	if ( isset($yacht[0]) )
	// 	{
	// 		return [
	// 			'name' => $yacht[0]['name'] . ', ' . $yacht[0]['yacht'] . ' ' . $yacht[0]['type'] . ' - ' . $yacht[0]['ft'] . ' pies (' . $yacht[0]['year'] . ')',
	// 			'costs' => $yacht[0]['costs'],
	// 			'hour_extra_cost' => $yacht[0]['hour_extra']
	// 		];
	// 	}
	// 	else
	// 		return ['name'=>''];
	// }
	//
	// public function get_includes() : array
	// {
	// 	return [
	// 		'normal' => [
	// 			'name' => 'Normal',
	// 			'selected' => true
	// 		],
	// 		'ceviche' => [
	// 			'name' => 'Ceviche'
	// 		],
	// 		'guacamole' => [
	// 			'name' => 'Guacamole'
	// 		],
	// 		'sandwiches' => [
	// 			'name' => 'Sandwiches'
	// 		],
	// 		'juice' => [
	// 			'name' => 'Jugo'
	// 		],
	// 		'cake' => [
	// 			'name' => 'Pastel'
	// 		],
	// 		'others' => [
	// 			'name' => 'Otros'
	// 		]
	// 	];
	// }
	//
	// public function get_amenities( $ids = null  ) : array
	// {
	// 	$where = [
	// 		'ORDER' => ['price' => 'ASC']
	// 	];
	//
	// 	if ( !is_null($ids) && is_array($ids) )
	// 	{
	// 		$find_ids = [];
	//
	// 		foreach ( $ids as $key => $value )
	// 		{
	// 			if ( !isset($value['id']) ) unset($ids[$key]);
	// 			else $find_ids[] = $value['id'];
	// 		}
	//
	// 		if ( count($find_ids) > 0 ) $where['id'] = $find_ids;
	// 	}
	//
	// 	$response = $this->database->select('amenities', [
	// 		'id',
	// 		'name',
	// 		'price'
	// 	], $where);
	//
	// 	if ( is_array($ids) && empty($ids) )
	// 		return [];
	// 	else
	// 		return $response;
	// }
	//
	// public function payment_references( $folio = null ) : array
	// {
	// 	return $this->database->select('payment_references', [
	// 		'date',
	// 		'type',
	// 		'amount',
	// 		'reference',
	// 		'notes',
	// 		'attachment',
	// 		'creation_date',
	// 	], [
	// 		'AND' => [
	// 			'folio_reservation' => $folio,
	// 			'status' => 'available'
	// 		]
	// 	]);
	// }
	//
	// public function expenses( $folio = null ) : array
	// {
	// 	return $this->database->select('expenses', [
	// 		'date',
	// 		'expenditure',
	// 		'amount',
	// 		'attachment',
	// 		'notes',
	// 		'creation_date',
	// 	], [
	// 		'AND' => [
	// 			'folio_reservation' => $folio,
	// 			'status' => 'available'
	// 		]
	// 	]);
	// }

	// INSERTS
	// public function insert_new_reservation( $data = null ) : bool
	// {
	// 	if ( is_null($data) )
	// 		return false;
	//
	// 	$this->database->insert('reservations', $data);
	//
	// 	if ( $this->database->id() )
	// 		return true;
	// 	else
	// 		return false;
	// }

	// UPDATES
	// public function update_reservation( $data = null )
	// {
	// 	if ( is_null($data) )
	// 		return false;
	//
	// 	$this->database->update('reservations', $data, [
	// 		'folio' => $data['folio']
	// 	]);
	// }
	//
	// public function update_reservations_status( $data = null )
	// {
	// 	if ( is_null($data) )
	// 		return false;
	//
	// 	$this->database->update('reservations', [
	// 		'status' => $data['value']
	// 	], [
	// 		'folio' => $data['folio']
	// 	]);
	// }
	//
	// public function update_payment_status( $data = null )
	// {
	// 	if ( is_null($data) )
	// 		return false;
	//
	// 	$this->database->update('reservations', [
	// 		'payment_status' => $data['value']
	// 	], [
	// 		'folio' => $data['folio']
	// 	]);
	// }
}
