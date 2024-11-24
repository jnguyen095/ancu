<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 11/1/2017
 * Time: 4:48 PM
 */
class MySendMail_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function sendEmail($toEmail, $title, $message){
		$config['protocol'] = MAIL_PROTOCAL;
		$config['smtp_host'] = MAIL_HOST; // Replace with your SMTP server
		$config['smtp_user'] = MAIL_SMTP_USER; // Your SMTP username
		$config['smtp_pass'] = MAIL_SMTP_PASS; // Your SMTP password
		$config['smtp_port'] = MAIL_SMTP_PORT; // Typically 587 for TLS, 465 for SSL
		$config['smtp_crypto'] = 'tls'; // Can be 'ssl' or 'tls'
		$config['mailtype'] = 'html'; // Send email as HTML
		$config['charset'] = 'utf-8'; // Character set
		$config['wordwrap'] = TRUE; // Wordwrap for email content
		$config['newline'] = "\r\n"; // Set newline character for email

		$this->email->initialize($config);
		///
		$this->email->from('info@nhadatancu.com', 'Nhà Đất An Cư');
		$this->email->to($toEmail);

		$this->email->subject($title);
		$this->email->message($message);

		if ($this->email->send()) {
			return true;
		} else {
			//echo "Email sending failed.";
			//echo $this->email->print_debugger();
			return false;
		}

	}
}
