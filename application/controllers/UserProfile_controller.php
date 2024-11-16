<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 8/24/2017
 * Time: 7:19 PM
 */
class UserProfile_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			redirect('dang-nhap');
		}
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		//$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('User_Model');
		//load the login model
		$this->load->model('Login_Model');
		$this->load->model('Category_Model');
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$userId = $this->session->userdata('loginid');
		$data = $this->Category_Model->getCategories();
		$data['UserId'] = $userId;
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$user = $this->User_Model->getUserById($userId);
		$data['txt_phone'] = $user->Phone;
		$crudaction = $this->input->post("crudaction");
		if($crudaction == UPDATE){
			$this->form_validation->set_rules("txt_fullname", "Fullname", "trim|required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			// $this->form_validation->set_rules('txt_phone', 'Mobile Number ', 'regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number

			$data['txt_fullname'] = $this->input->post("txt_fullname");
			$data['txt_email'] = $this->input->post("txt_email");
			$data['txt_address'] = $this->input->post("txt_address");
			$data['txt_bio'] = $this->input->post('txt_bio');
			$newAvatar = $this->uploadImage();
			if(isset($newAvatar) && !empty($newAvatar)){
				$data['txt_avatar'] = $newAvatar;
			} else {
				$data['txt_avatar'] = $this->input->post('txt_currentAvatar');
			}
			if ($this->form_validation->run()) {
				$this->User_Model->updateUser($data);
				$data['message_response'] = 'Cập nhật thành công';
			}
		}else{
			$data['txt_fullname'] = $user->FullName;
			$data['txt_email'] = $user->Email;
			$data['txt_phone'] = $user->Phone;
			$data['txt_address'] = $user->Address;
			$data['txt_bio'] = $user->Bio;
			$data['txt_avatar'] = $user->Avatar;
		}
		$this->load->view('user/profile', $data);
	}

	public function changePassword(){
		$userId = $this->session->userdata('loginid');
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$crudaction = $this->input->post("crudaction");
		if($crudaction == UPDATE){
			$this->form_validation->set_rules("txt_oddpw", "Mật khẩu cũ", "trim|required");
			$this->form_validation->set_rules("txt_newpw", "Mật khẩu mới", "trim|required");
			$this->form_validation->set_rules("txt_newpwconfirm", "Xác nhận mật khẩu mới", "trim|required");
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('user/changePassword', $data);
			}else{
				$oddPw = $this->input->post("txt_oddpw");
				$newPw = $this->input->post("txt_newpw");
				$newPwConfirm = $this->input->post("txt_newpwconfirm");

				$user = $this->User_Model->getUserById($userId);
				$oddPwDb = $user->Password;
				if($oddPwDb != md5($oddPw)){
					$data['error_response'] = 'Mật khẩu đang sử dụng không đúng';
				}else if($newPw != $newPwConfirm){
					$data['error_response'] = 'Mật khẩu mới không khớp';
				}else{
					$this->User_Model->changePassword($userId, $newPw);
					$data['message_response'] = 'Cập nhật thành công';
				}
				$this->load->view('user/changePassword', $data);
			}
		}else {
			$this->load->view('user/changePassword', $data);
		}
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
