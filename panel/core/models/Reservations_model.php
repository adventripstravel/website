<?php
defined('_EXEC') or die;

class Reservations_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// GETS
	public function get_reservations_by_folio( $folio = null )
	{
		$response = $this->database->select('bookings', [
			'folio',
			'customer [Object]',
			'paxes [Object]',
			'observations',
			'data [Object]',
			'tour [Object]',
			'status',
			'status_payment',
			'creation_date'
		], [
			'folio' => $folio
		]);

		return ( isset($response[0]) && !empty($response[0]) ) ? $response[0] : null;
	}

	// INSERTS

	// UPDATES
	public function edit_status( $value = null, $folio = null )
	{
		$this->database->update('bookings', [
			'status' => $value
		], [
			'folio' => $folio
		]);

		if ( $value == 'available' )
		{
			$ticket = $this->get_reservations_by_folio($folio);

			$notification = new Send_email_notifications();

			$mail = new Mailer(true);
			// $mail->SMTPDebug = 3;
			$mail->isSMTP();
			$mail->setFrom('noreplay@adventrips.com', 'Adventrips');
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ] ];
			$mail->addAddress($ticket['customer']['email']);
			$mail->Subject = "Ahora esta disponible tu reservación #{$ticket['folio']}";
			$mail->msgHTML( $notification->get_template( $ticket, 'notification_new_reservation.php' ) );

			try {
				$mail->send();
			} catch (Exception $e) {}
		}
	}
}
