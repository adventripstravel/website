<?php
defined('_EXEC') or die;

class Send_email_notifications
{
    private $database;

    public function __construct()
    {
        $this->database = new Medoo();
    }

    private function get_template( $arr = null, $template = null )
    {
        if ( !is_null( $arr ) )
        {
            global $data;

            $data = $arr;

            ob_start();

            $template = ( is_null($template) ) ? 'notification_new_reservation.php' : $template;

            require_once Security::DS(PATH_INCLUDES . $template);

            $buffer = ob_get_contents();

            ob_end_clean();

            return $buffer;
        }

        return null;
    }

    public function new_reservation( $folio = null )
    {
        if ( !is_null( $folio ) )
        {
            $ticket = $this->database->select('bookings', [
                'folio',
                'customer [Object]'
            ], [
                'folio' => $folio
            ]);

            if ( isset($ticket[0]) && !empty($ticket[0]) )
            {
                $ticket = $ticket[0];

                $mail = new Mailer(true);
                // $mail->SMTPDebug = 3;
                $mail->isSMTP();
                $mail->setFrom('noreplay@adventrips.com', 'Adventrips');
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ] ];

                // SEND EMAIL CUSTOMER
                $mail->addAddress($ticket['customer']['email'], $ticket['customer']['fistname'] .' '. $ticket['customer']['lastname']);
                $mail->Subject = "Reservación número #{$ticket['folio']}";
                $mail->msgHTML( $this->get_template( $ticket ) );

                try {
                    $mail->send();
                } catch (Exception $e) {}

                $mail->clearAddresses();

                // SEND EMAIL ADMINISTRATOR
                // $mail->addAddress('contacto@yachtmstr.com');
                // $mail->Subject = "Nueva reservacion en yachtmstr.com #{$ticket['folio']}";
                // $mail->msgHTML( $this->get_template( $ticket, 'notification_new_reservation.admin.php' ) );
                //
                // try {
                //     $mail->send();
                // } catch (Exception $e) {}

                return true;
            }

            return null;
        }

        return null;
    }
}
