<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 8/24/2017
 * Time: 4:13 PM
 */
class Register_controller extends CI_Controller
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
		$this->load->model('User_Model');
		$this->load->model('City_Model');
		$this->load->model('Category_Model');
		$this->load->model('ProCode_Model');
		$this->load->helper("seo_url");
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
		// end file cached

		if($this->input->post('crudaction') == "register"){
			$this->form_validation->set_message('txt_fullname', 'Họ tên không được để trống');

			$this->form_validation->set_rules("txt_fullname", "Họ tên", "trim|required");
			//$this->form_validation->set_rules("txt_phone", "Số điện thoại", "trim|required");
			$this->form_validation->set_rules("txt_password", "Mật khẩu", "trim|required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules('txt_phone', 'Số điện thoại', 'trim|required|regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number

			if ($this->form_validation->run()) {
				$fullname = $this->input->post('txt_fullname');
				$password = $this->input->post('txt_password');
				$email = $this->input->post('txt_email');
				$phone = $this->input->post('txt_phone');
				$address = $this->input->post('txt_address');

				$count = $this->User_Model->checkExistUserName($phone);
				if($count > 0){
					$data['error_response'] = 'Số điện thoại này đã có trong hệ thống, vui lòng kiểm tra lại';
					$this->load->view('login/register', $data);
				}else{
					$newdata['Us3rID'] = null;
					$newdata['fullname'] = $fullname;
					$newdata['password'] = $password;
					$newdata['email'] = $email;
					$newdata['phone'] = $phone;
					$newdata['address'] = $address;
					$newdata['bio'] = null;
					$newdata['avatar'] = null;

					$this->User_Model->addNewUser($newdata, USER_GROUP_CUSTOMER);
					$data['message_response'] = 'Đăng ký thành công';
				}
			}
		}
		$this->load->view('login/register', $data);
	}

	public function broker()
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
		// end file cached
		$data['txt_bio'] = "";
		$data['txt_avatar'] = "";
		if($this->input->post('crudaction') == "register"){
			$this->form_validation->set_message('txt_fullname', 'Họ tên không được để trống');

			$this->form_validation->set_rules("txt_fullname", "Họ tên", "trim|required");
			$this->form_validation->set_rules("txt_procode", "Mã giới thiệu", "trim|required");
			$this->form_validation->set_rules("txt_password", "Mật khẩu", "trim|required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules('txt_phone', 'Số điện thoại', 'trim|required|regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number

			if ($this->form_validation->run()) {
				$fullname = $this->input->post('txt_fullname');
				$password = $this->input->post('txt_password');
				$email = $this->input->post('txt_email');
				$phone = $this->input->post('txt_phone');
				$address = $this->input->post('txt_address');
				$code = $this->input->post('txt_procode');
				$newAvatar = $this->uploadImage();
				if(isset($newAvatar) && !empty($newAvatar)){
					$data['txt_avatar'] = $newAvatar;
				} else {
					$data['txt_avatar'] = $this->input->post('txt_currentAvatar');
				}

				$num = $this->ProCode_Model->countIfValidCode($code, "PRO_CODE_BROKER");
				if($num < 1){
					$data['error_response'] = 'Mã giới thiệu không hợp lệ vui lòng kiểm tra lại';
				} else {
					$count = $this->User_Model->checkExistUserName($phone);
					if($count > 0){
						$data['error_response'] = 'Số điện thoại này đã có trong hệ thống, vui lòng kiểm tra lại';
						$this->load->view('login/register-broker', $data);
					}else{
						$newdata['Us3rID'] = null;
						$newdata['fullname'] = $fullname;
						$newdata['password'] = $password;
						$newdata['email'] = $email;
						$newdata['phone'] = $phone;
						$newdata['address'] = $address;
						$newdata['bio'] = $this->input->post('txt_bio');
						$newdata['avatar'] = $data['txt_avatar'];

						$this->User_Model->addNewUser($newdata, USER_GROUP_BROKER);
						$data['message_response'] = 'Bạn đã đăng ký thành công tài khoản chuyên viên, hãy đăng nhập';
					}
				}
			}
		}
		$this->load->view('login/register-broker', $data);
	}

	private function uploadImage(){
		if($_FILES['txt_avatar']['error'] !== 4){ // file is going to upload
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. DIRECTORY_SEPARATOR;

			if (!file_exists($upath)) {
				mkdir($upath, 0777, true);
			}

			$config['upload_path'] = $upath;
			$config['allowed_types'] = $this->config->item('allowed_img_types');
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('txt_avatar')) {
				log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			}
			$img = $this->upload->data();

			if ($img['file_name'] != null) {
				// Resize image
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upath.$img['file_name'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 120;

				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$imgDetailArray = explode('.', $img['file_name']);
				$thumbimgname = $imgDetailArray[0].'_thumb'.'.'.$imgDetailArray[1];

				// unlink($upath.$img['file_name']);
				return "/".$upath.$thumbimgname;
			}
		}else {
			return "";
		}
	}
}
