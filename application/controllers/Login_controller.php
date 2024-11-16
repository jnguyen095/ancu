<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 7/31/2017
 * Time: 11:29 AM
 */
class Login_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		//$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('Login_Model');
		$this->load->model('City_Model');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function logout(){
		$this->unsetSession();
		redirect("trang-chu");
	}

	public function socialLogin(){
		$this->unsetSession();
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');

		$userID = $this->Login_Model->get_facebooker($username, $password, $fullname);

		$data = array(
			'success' => false
		);
		if($userID != null && $userID > 0){
			$data = array(
				'success' => true
			);
			$sessiondata = array(
				'loginid' => $userID,
				'username' => $username,
				'fullname' => $fullname,
				'loginuser' => TRUE
			);
			$this->Login_Model->updateLastLogin($userID);
			$this->session->set_userdata($sessiondata);
		}

		//Either you can print value or you can send value to database
		echo json_encode($data);
	}

	public function index()
	{
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;
		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		//get the posted values
		$phone = $this->input->post("txt_phone");
		$password = $this->input->post("txt_password");
		$remember_me = $this->input->post("ch_rememberme");

		//set validations
		$this->form_validation->set_rules("txt_phone", "Số điện thoại", "trim|required");
		$this->form_validation->set_rules("txt_password", "Mật khẩu", "trim|required");

		if ($this->form_validation->run() == FALSE)
		{
			//validation fails
			$this->load->view('login/login', $data);
		}
		else
		{
			//validation succeeds
			if ($this->input->post('crudaction') == "Login")
			{
				$this->unsetSession();
				//check if username and password is correct
				$usr_result = $this->Login_Model->get_user($phone, $password);
				if ($usr_result != null) //active user record is present
				{
					//set the session variables
					$sessiondata = array(
						'loginid' => $usr_result->Us3rID,
						'phone' => $phone,
						'fullname' => $usr_result->FullName,
						'loginuser' => TRUE,
						'usergroup' => $usr_result->UserGroup
					);
					$this->session->set_userdata($sessiondata);
					$this->Login_Model->updateLastLogin($usr_result->Us3rID);
					if($usr_result->UserGroup == 'ADMIN'){
						redirect("admin/dashboard");
					}else{
						redirect("trang-chu");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Số điện thoại hoặc mật khẩu không đúng!</div>');
					redirect('dang-nhap');
				}
			}
			else
			{
				redirect('dang-nhap');
			}
		}
	}

	function unsetSession(){
		$this->session->unset_userdata('phone');
		$this->session->unset_userdata('loginuser');
		$this->session->unset_userdata('loginid');
		$this->session->unset_userdata('usergroup');
		$this->session->unset_userdata('fullname');
	}
}
