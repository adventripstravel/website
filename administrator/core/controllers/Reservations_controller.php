<?php
defined('_EXEC') or die;

class Reservations_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// AJAX
	// public function get_data_ajax()
	// {
	// 	if ( Format::exist_ajax_request() )
	// 	{
	// 		$_POST['action'] = (isset($_POST['action'])) ? $_POST['action'] : '';
	//
	// 		switch ( $_POST['action'] )
	// 		{
	// 			case 'get_data_origin_reservations':
	// 				$response = $this->model->get_origins_reservations();
	//
	// 				if ( isset($response[$_POST['value']]) ) $return = $response[$_POST['value']];
	// 				break;
	//
	// 			case 'get_partners':
	// 				$response = $this->model->get_partners();
	//
	// 				if ( isset($response[$_POST['value']]) ) $return = $response[$_POST['value']];
	// 				break;
	//
	// 			case 'get_boats':
	// 				$response = $this->model->get_boats($_POST['value']);
	//
	// 				$response[0]['costs_min'] = ( in_array(Session::get_value('_vkye_level'), ['{sysadmina}', '{partner}', '{manager}']) ) ? false : true;
	//
	// 				if ( !is_null($response[0]) ) $return = $response[0];
	// 				break;
	//
	// 			case 'send_notification':
	// 				$notification = new Send_email_notifications();
	// 				$notification->new_reservation( ( isset($_POST['folio']) ) ? $_POST['folio'] : null );
	//
	// 				$return = '<span>OK</span>';
	// 				break;
	//
	// 			case 'reservations_status':
	// 				if ( in_array('{reservations_status}', Session::get_value('session_permissions')) )
	// 				{
	// 					$this->model->update_reservations_status($_POST);
	// 					$return = '<span>OK</span>';
	// 				}
	// 				else
	// 				{
	// 					echo json_encode([
	// 						'status' => 'error',
	// 						'data' => 'No tienes los permisos para realizar esta acción.'
	// 					], JSON_PRETTY_PRINT);
	//
	// 					return null;
	// 				}
	// 				break;
	//
	// 			case 'payment_status':
	// 				if ( in_array('{reservations_payment}', Session::get_value('session_permissions')) )
	// 				{
	// 					$this->model->update_payment_status($_POST);
	// 					$return = '<span>OK</span>';
	// 				}
	// 				else
	// 				{
	// 					echo json_encode([
	// 						'status' => 'error',
	// 						'data' => 'No tienes los permisos para realizar esta acción.'
	// 					], JSON_PRETTY_PRINT);
	//
	// 					return null;
	// 				}
	// 				break;
	// 		}
	// 	}
	//
	// 	if ( isset($return) )
	// 	{
	// 		echo json_encode([
	// 			'status' => 'OK',
	// 			'data' => $return
	// 		], JSON_PRETTY_PRINT);
	// 	}
	// 	else header("HTTP/1.0 404 Not Found");
	// }

	// public function index( $params )
	// {
	// 	global $reservations;
	//
	// 	$reservations = $this->model->get_reservations();
	//
	// 	define('_title', 'Reservaciones - {$vkye_webpage}');
	// 	echo $this->view->render($this, 'index');
	// }

	// public function validate_reservation( $data = [] )
	// {
	// 	$post['origin'] = ( isset($data['origin']) && !empty($data['origin']) ) ? $data['origin'] : null;
	// 	$post['customer_name'] = ( isset($data['customer_name']) && !empty($data['customer_name']) ) ? $data['customer_name'] : null;
	// 	$post['customer_email'] = ( isset($data['customer_email']) && !empty($data['customer_email']) ) ? $data['customer_email'] : null;
	// 	$post['customer_phone'] = ( isset($data['customer_phone']) && !empty($data['customer_phone']) ) ? '+'. str_replace(['(',')','-',' '], '', $data['prefix'] . $data['customer_phone']) : null;
	// 	$post['yacht_name'] = ( isset($data['yacht_name']) && !empty($data['yacht_name']) ) ? $data['yacht_name'] : null;
	// 	$post['yacht_pax_adults'] = ( isset($data['yacht_pax_adults']) && !empty($data['yacht_pax_adults']) ) ? (int) $data['yacht_pax_adults'] : 0;
	// 	$post['yacht_pax_childrens'] = ( isset($data['yacht_pax_childrens']) && !empty($data['yacht_pax_childrens']) ) ? (int) $data['yacht_pax_childrens'] : 0;
	// 	$post['yacht_hrs_duration'] = ( isset($data['yacht_hrs_duration']) && !empty($data['yacht_hrs_duration']) ) ? (int) $data['yacht_hrs_duration'] : 0;
	// 	$post['yacht_price'] = ( isset($data['yacht_price']) && !empty($data['yacht_price']) ) ? (int) $data['yacht_price'] : 0;
	// 	$post['dockage'] = ( isset($data['dockage']) && !empty($data['dockage']) ) ? (int) $data['dockage'] : 0;
	// 	$post['reservation_date'] = ( isset($data['reservation_date']) && !empty($data['reservation_date']) ) ? $data['reservation_date'] : null;
	// 	$post['reservation_hour'] = ( isset($data['reservation_hour']) && !empty($data['reservation_hour']) ) ? $data['reservation_hour'] : null;
	// 	$post['reservation_discount'] = ( isset($data['reservation_discount']) && !empty($data['reservation_discount']) ) ? ($data['reservation_discount'] !== 'no') ? $data['reservation_discount'] : null : null;
	// 	$post['includes'] = ( isset($data['includes']) && !empty($data['includes']) ) ? $data['includes'] : [];
	// 	$post['includes_others'] = ( isset($data['includes_others']) && !empty($data['includes_others']) ) ? $data['includes_others'] : null;
	// 	$post['notes'] = ( isset($data['notes']) && !empty($data['notes']) ) ? $data['notes'] : null;
	// 	$post['reservation_amount_payment'] = ( isset($data['reservation_amount_payment']) && !empty($data['reservation_amount_payment']) ) ? $data['reservation_amount_payment'] : null;
	// 	$post['hidden_price'] = ( isset($data['hidden_price']) && !empty($data['hidden_price']) ) ? ( $data['hidden_price'] === 'show' ) ? false : true : true;
	//
	// 	$labels = [];
	//
	// 	if ( is_null($post['origin']) )
	// 		array_push($labels, ['origin', 'Debes seleccionar de donde proviene la reservación.']);
	// 	else if ( $post['origin'] === 'other' )
	// 	{
	// 		if ( !isset($data['origin_name']) || empty($data['origin_name']) )
	// 			array_push($labels, ['origin_name', '']);
	// 		else
	// 			$post['origin'] = $data['origin_name'];
	// 	}
	//
	// 	if ( is_null($post['customer_name']) )
	// 		array_push($labels, ['customer_name', '']);
	//
	// 	if ( is_null($post['customer_email']) )
	// 		array_push($labels, ['customer_email', '']);
	//
	// 	if ( is_null($post['customer_phone']) )
	// 		array_push($labels, ['customer_phone', '']);
	//
	// 	if ( is_null($post['yacht_name']) )
	// 		array_push($labels, ['yacht_name', 'Debes seleccionar un yate.']);
	// 	else if ( $post['yacht_name'] === 'other' )
	// 	{
	// 		if ( !isset($data['yacht_name_custom']) || empty($data['yacht_name_custom']) )
	// 			array_push($labels, ['yacht_name_custom', '']);
	// 		else
	// 			$post['yacht_name'] = $data['yacht_name_custom'];
	// 	}
	//
	// 	if ( $post['yacht_pax_adults'] <= 0 )
	// 		array_push($labels, ['yacht_pax_adults', '']);
	//
	// 	if ( $post['yacht_hrs_duration'] <= 0 )
	// 		array_push($labels, ['yacht_hrs_duration', '']);
	//
	// 	if ( is_null($post['reservation_date']) )
	// 		array_push($labels, ['reservation_date', '']);
	//
	// 	if ( is_null($post['reservation_hour']) )
	// 		array_push($labels, ['reservation_hour', '']);
	//
	// 	if ( $post['reservation_discount'] === 'percentage' )
	// 	{
	// 		if ( !isset($data['reservation_percentage_discount']) || empty($data['reservation_percentage_discount']) )
	// 			array_push($labels, ['reservation_percentage_discount', '']);
	// 		else
	// 		{
	// 			$post['reservation_discount'] = [
	// 				'type' => $post['reservation_discount'],
	// 				'amount' => $data['reservation_percentage_discount']
	// 			];
	// 		}
	// 	}
	//
	// 	if ( $post['reservation_discount'] === 'amount' )
	// 	{
	// 		if ( !isset($data['reservation_amount_discount']) || empty($data['reservation_amount_discount']) )
	// 			array_push($labels, ['reservation_amount_discount', '']);
	// 		else
	// 		{
	// 			$post['reservation_discount'] = [
	// 				'type' => $post['reservation_discount'],
	// 				'amount' => $data['reservation_amount_discount']
	// 			];
	// 		}
	// 	}
	//
	// 	if ( is_null($post['reservation_amount_payment']) )
	// 		array_push($labels, ['reservation_amount_payment', 'Debes seleccionar de donde proviene la reservación.']);
	// 	else if ( $post['reservation_amount_payment'] === 'coupon' )
	// 	{
	// 		if ( !isset($data['coupon']) || empty($data['coupon']) )
	// 			array_push($labels, ['coupon', '']);
	// 		else
	// 			$post['reservation_amount_payment'] = 'Cupón - '. $data['coupon'];
	// 	}
	// 	else if ( $post['reservation_amount_payment'] === 'other' )
	// 	{
	// 		if ( !isset($data['other_payment']) || empty($data['other_payment']) )
	// 			array_push($labels, ['other_payment', '']);
	// 		else
	// 			$post['reservation_amount_payment'] = $data['other_payment'];
	// 	}
	//
	// 	if ( !empty($labels) )
	// 	{
	// 		return [
	// 			'status' => 'error',
	// 			'data' => $labels
	// 		];
	// 	}
	// 	else
	// 	{
	// 		return [
	// 			'status' => 'success',
	// 			'data' => $post
	// 		];
	// 	}
	// }

	public function create( $params )
	{
		if ( Format::exist_ajax_request() )
		{
			echo json_encode([
				'status' => 'success',
				'redirect' => 'index.php?c=reservations&m=view&folio='
			], JSON_PRETTY_PRINT);
		}
		else
		{
			global $ladas;

			$ladas = $this->format->import_file(PATH_ADMINISTRATOR_INCLUDES, 'code_countries_lada', 'json');

			define('_title', 'Agregar reservación - {$vkye_webpage}');
			echo $this->view->render($this, 'create');
		}
	}

	// public function view( $param = null )
	// {
	// 	$folio = ( isset($param['folio']) ) ? $param['folio'] : null;
	// 	$response = $this->model->get_reservations($folio);
	//
	// 	if ( isset($param['folio']) && isset($response[0]) )
	// 	{
	// 		$response = $response[0];
	//
	// 		// Esto es para reservaciones viejas, que no teninan el soporte del prefijo telefónico.
	// 		$response['data']['customer']['phone'] = ( strlen($response['data']['customer']['phone']) === 10 ) ? '+52'. $response['data']['customer']['phone'] : $response['data']['customer']['phone'];
	//
	// 		if ( Format::exist_ajax_request() )
	// 		{
	// 			if ( in_array('{reservations_update}', Session::get_value('session_permissions')) )
	// 			{
	// 				$post['origin'] = ( isset($_POST['origin']) && !empty($_POST['origin']) ) ? $_POST['origin'] : null;
	// 				$post['customer_name'] = ( isset($_POST['customer_name']) && !empty($_POST['customer_name']) ) ? $_POST['customer_name'] : null;
	// 				$post['customer_email'] = ( isset($_POST['customer_email']) && !empty($_POST['customer_email']) ) ? $_POST['customer_email'] : null;
	// 				$post['customer_phone'] = ( isset($_POST['customer_phone']) && !empty($_POST['customer_phone']) ) ? '+'. str_replace(['(',')','-',' '], '', $_POST['prefix'] . $_POST['customer_phone']) : null;
	// 				$post['yacht_name'] = ( isset($_POST['yacht_name']) && !empty($_POST['yacht_name']) ) ? $_POST['yacht_name'] : null;
	// 				$post['reservation_date'] = ( isset($_POST['reservation_date']) && !empty($_POST['reservation_date']) ) ? $_POST['reservation_date'] : null;
	// 				$post['reservation_hour'] = ( isset($_POST['reservation_hour']) && !empty($_POST['reservation_hour']) ) ? $_POST['reservation_hour'] : null;
	// 				$post['yacht_hrs_duration'] = ( isset($_POST['yacht_hrs_duration']) && !empty($_POST['yacht_hrs_duration']) ) ? (int) $_POST['yacht_hrs_duration'] : 0;
	// 				$post['yacht_pax_adults'] = ( isset($_POST['yacht_pax_adults']) && !empty($_POST['yacht_pax_adults']) ) ? (int) $_POST['yacht_pax_adults'] : 0;
	// 				$post['yacht_pax_childrens'] = ( isset($_POST['yacht_pax_childrens']) && !empty($_POST['yacht_pax_childrens']) ) ? (int) $_POST['yacht_pax_childrens'] : 0;
	// 				$post['yacht_price'] = ( isset($_POST['yacht_price']) && !empty($_POST['yacht_price']) ) ? (int) $_POST['yacht_price'] : 0;
	// 				$post['dockage'] = ( isset($_POST['dockage']) && !empty($_POST['dockage']) ) ? (int) $_POST['dockage'] : 0;
	// 				$post['includes'] = ( isset($_POST['includes']) && !empty($_POST['includes']) ) ? $_POST['includes'] : [];
	// 				$post['includes_others'] = ( isset($_POST['includes_others']) && !empty($_POST['includes_others']) ) ? $_POST['includes_others'] : '';
	// 				$post['min_amount_reservation'] = ( isset($_POST['min_amount_reservation']) ) ? (int) $_POST['min_amount_reservation'] : 30;
	// 				$post['notes'] = ( isset($_POST['notes']) && !empty($_POST['notes']) ) ? $_POST['notes'] : null;
	//
	// 				$labels = [];
	//
	// 				if ( is_null($post['origin']) )
	// 					array_push($labels, ['origin', 'Debes seleccionar de donde proviene la reservación.']);
	// 				else if ( $post['origin'] === 'other' )
	// 				{
	// 					if ( !isset($_POST['origin_name']) || empty($_POST['origin_name']) )
	// 						array_push($labels, ['origin_name', '']);
	// 					else
	// 						$post['origin'] = $_POST['origin_name'];
	// 				}
	//
	// 				if ( is_null($post['customer_name']) )
	// 					array_push($labels, ['customer_name', '']);
	//
	// 				if ( is_null($post['customer_email']) )
	// 					array_push($labels, ['customer_email', '']);
	//
	// 				if ( is_null($post['customer_phone']) )
	// 					array_push($labels, ['customer_phone', '']);
	//
	// 				if ( is_null($post['yacht_name']) )
	// 					array_push($labels, ['yacht_name', '']);
	//
	// 				if ( is_null($post['reservation_date']) )
	// 					array_push($labels, ['reservation_date', '']);
	//
	// 				if ( is_null($post['reservation_hour']) )
	// 					array_push($labels, ['reservation_hour', '']);
	//
	// 				if ( is_null($post['yacht_hrs_duration']) )
	// 					array_push($labels, ['yacht_hrs_duration', '']);
	//
	// 				if ( is_null($post['yacht_pax_adults']) )
	// 					array_push($labels, ['yacht_pax_adults', '']);
	//
	// 				if ( is_null($post['yacht_price']) )
	// 					array_push($labels, ['yacht_price', '']);
	//
	// 				if ( empty($labels) )
	// 				{
	// 					$yacht_data = null;
	// 					$yacht_costs = [
	// 						'report_price' => 0,
	// 						'public_price' => 0,
	// 						'online_price' => 0
	// 					];
	//
	// 					if ( is_numeric($post['yacht_name']) )
	// 					{
	// 						$response['data']['yacht']['id'] = (int) $post['yacht_name'];
	// 						$yacht_data = $this->model->get_yacht_data( $response['data']['yacht']['id'] );
	// 						$response['data']['yacht']['name'] = $yacht_data['name'];
	//
	// 						if ( $response['data']['yacht']['duration'] > 8 )
	// 						{
	// 							$hrs_extra = $response['data']['yacht']['duration'] - 8;
	// 							$hrs_extra_cost = $hrs_extra * $yacht_data['hour_extra_cost'];
	//
	// 							$yacht_costs = [
	// 								'report_price' => $yacht_data['costs'][8]['report_price'] + $hrs_extra_cost,
	// 								'public_price' => $yacht_data['costs'][8]['public_price'] + $hrs_extra_cost,
	// 								'online_price' => $yacht_data['costs'][8]['online_price'] + $hrs_extra_cost
	// 							];
	// 						}
	// 						else
	// 						{
	// 							$yacht_costs = [
	// 								'report_price' => $yacht_data['costs'][$response['data']['yacht']['duration']]['report_price'],
	// 								'public_price' => $yacht_data['costs'][$response['data']['yacht']['duration']]['public_price'],
	// 								'online_price' => $yacht_data['costs'][$response['data']['yacht']['duration']]['online_price']
	// 							];
	// 						}
	// 					}
	// 					else
	// 					{
	// 						$post['yacht_id'] = null;
	// 						$response['data']['yacht']['name'] = $post['yacht_name'];
	// 					}
	//
	// 					if ( $post['origin'] === 'partners' )
	// 					{
	// 						$yacht_costs = [
	// 							'report_price' => 0,
	// 							'public_price' => 0,
	// 							'online_price' => 0
	// 						];
	// 					}
	//
	// 					$response['origin'] = $post['origin'];
	// 					$response['customer_name'] = $post['customer_name'];
	// 					$response['customer_email'] = $post['customer_email'];
	// 					$response['reservation_date'] = $post['reservation_date'] .' '. $post['reservation_hour'] .':00';
	// 					$response['data']['customer']['name'] = $post['customer_name'];
	// 					$response['data']['customer']['email'] = $post['customer_email'];
	// 					$response['data']['customer']['phone'] = $post['customer_phone'];
	// 					$response['data']['reservation']['date'] = $post['reservation_date'];
	// 					$response['data']['reservation']['hour'] = $post['reservation_hour'];
	// 					$response['data']['yacht']['duration'] = (int) $post['yacht_hrs_duration'];
	// 					$response['data']['yacht']['pax']['adults'] = (int) $post['yacht_pax_adults'];
	// 					$response['data']['yacht']['pax']['childrens'] = (int) $post['yacht_pax_childrens'];
	// 					$response['data']['yacht']['price'] = (int) $post['yacht_price'];
	// 					$response['data']['yacht']['dockage'] = (int) $post['dockage'];
	// 					$response['data']['reservation']['includes']['list'] = $post['includes'];
	// 					$response['data']['reservation']['includes']['notes'] = $post['includes_others'];
	// 					$response['data']['reservation']['notes'] = $post['notes'];
	// 					$response['data']['payment']['min_amount_reservation'] = $post['min_amount_reservation'];
	// 					$response['data']['version'] = '2.1';
	// 					$response['data']['metadata'] = $yacht_costs;
	//
	// 					$subtotal = $response['data']['yacht']['price'];
	// 					$subtotal += $response['data']['yacht']['dockage'] * $response['data']['yacht']['pax']['adults'];
	// 					$subtotal += $response['data']['reservation']['hours_extra']['price'] * $response['data']['reservation']['hours_extra']['hours_extra'];
	//
	// 					$total = $subtotal;
	//
	// 					if ( !is_null($response['data']['payment']['discount']) )
	// 					{
	// 						if ( $response['data']['payment']['discount']['type'] == 'amount' )
	// 							$total -= $response['data']['payment']['discount']['amount'];
	//
	// 						if ( $response['data']['payment']['discount']['type'] == 'percentage' )
	// 							$total = $subtotal - ($total * $response['data']['payment']['discount']['amount'] / 100);
	// 					}
	//
	// 					$response['data']['payment']['subtotal'] = (int) $subtotal;
	// 					$response['data']['payment']['total'] = (int) $total;
	//
	// 					$this->model->update_reservation($response);
	//
	// 					echo json_encode([
	// 						'status' => 'success',
	// 						'redirect' => 'index.php?c=reservations&m=view&folio='. $response['folio']
	// 					], JSON_PRETTY_PRINT);
	// 				}
	// 				else
	// 				{
	// 					echo json_encode([
	// 						'status' => 'error',
	// 						'labels' => $labels
	// 					], JSON_PRETTY_PRINT);
	// 				}
	// 			}
	// 			else
	// 			{
	// 				echo json_encode([
	// 					'status' => 'error',
	// 					'message' => 'No tienes permisos para realizar cambios.'
	// 				], JSON_PRETTY_PRINT);
	// 			}
	// 		}
	// 		else
	// 		{
	// 			global $reservation, $type_reservations, $partners, $boats, $includes, $amenities, $payment_references, $expenses;
	//
	// 			$reservation = $response;
	//
	// 			if ( !isset($reservation['data']['yacht']['dockage']) || is_null($reservation['data']['yacht']['dockage']) )
	// 				$reservation['data']['yacht']['dockage'] = 0;
	//
	// 			$type_reservations = $this->model->get_origins_reservations();
	// 			$partners = $this->model->get_partners();
	// 			$boats = $this->model->get_boats();
	// 			$includes = $this->model->get_includes();
	// 			$amenities = $this->model->get_amenities();
	// 			$payment_references = $this->model->payment_references( $reservation['folio'] );
	// 			$expenses = $this->model->expenses( $reservation['folio'] );
	//
	// 			define('_title', 'Viendo la reservación número: '. $reservation['folio']);
	// 			echo $this->view->render($this, 'view');
	// 		}
	// 	}
	// 	else Errors::http('404');
	// }
}
