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
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function htmlMail(){

		$this->load->library('email');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.nhadatancu.com'; // Replace with your SMTP server
		$config['smtp_user'] = 'info@nhadatancu.com'; // Your SMTP username
		$config['smtp_pass'] = 'p25khGAmY41P'; // Your SMTP password
		$config['smtp_port'] = 587; // Typically 587 for TLS, 465 for SSL
		$config['smtp_crypto'] = 'tls'; // Can be 'ssl' or 'tls'
		$config['mailtype'] = 'html'; // Send email as HTML
		$config['charset'] = 'utf-8'; // Character set
		$config['wordwrap'] = TRUE; // Wordwrap for email content
		$config['newline'] = "\r\n"; // Set newline character for email

		$this->email->initialize($config);

		///
		$this->email->from('info@nhadatancu.com', 'Nhà Đất An Cư');
		$this->email->to('nguyennhukhangvn@gmail.com');

		$this->email->subject('Test Email');
		$this->email->message('This is a test email sent using CodeIgniter.');


		if ($this->email->send()) {
			echo "Email sent successfully.";
		} else {
			echo "Email sending failed.";
			echo $this->email->print_debugger();
		}

	}
}
