<?php
/**
 * Description of Email
 *
 * @author Juan Pablo
 */
class Email_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function enviar_mail($vista,$to,$datosEmail,$titulo,$asunto) {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/lib/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from('ventas@nutritivoz.com', $titulo);
        $this->email->to($to);
        // $this->email->bcc('them@their-example.com');
        $this->email->subject($asunto);
        $this->email->set_mailtype("html");
        $this->email->message($this->load->view($vista, $datosEmail, true));
        $this->email->send();
    }

}
