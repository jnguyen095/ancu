<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 10/3/2017
 * Time: 10:25 AM
 */
class UserManagement_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			redirect('dang-nhap');
		}
		if($this->session->userdata('usergroup') != 'ADMIN'){
			redirect('/errors/html/error_404');
		}

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->model('User_Model');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/user/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "CreatedDate";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->User_Model->getAllUsers($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['users'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/user/list", $data);
	}

	public function staffList()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/staff/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "CreatedDate";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->User_Model->getAllStaff($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['staffs'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/staff/list", $data);
	}

	public function addUser($userId = null){
		$data = [];
		$fullname = $this->input->post('txt_fullname');
		$password = $this->input->post('txt_password');
		$email = $this->input->post('txt_email');
		$phone = $this->input->post('txt_phone');
		$address = $this->input->post('txt_address');
		$userGroupID = $this->input->post('txt_usergroup');
		$status = $this->input->post('ch_status');
		$bio = $this->input->post('txt_bio');
		$avatar = $this->input->post('txt_avatar');//$this->uploadImage();

		$data['txt_fullname'] = $fullname;
		$data['txt_password'] = $password;
		$data['txt_email'] = $email;
		$data['txt_phone'] = $phone;
		$data['txt_phone'] = $address;
		$data['txt_address'] = $address;
		$data['txt_usergroup'] = $userGroupID;
		$data['txt_bio'] = $bio;
		$data['txt_avatar'] = $avatar;
		$data['ch_status'] = isset($status) ? $status : ACTIVE;


		if($userId != null){
			$staff = $this->User_Model->getUserById($userId);
			$data['staffID'] = $staff->Us3rID;
			$data['txt_fullname'] = $staff->FullName;
			$data['txt_password'] = $staff->Password;
			$data['txt_email'] = $staff->Email;
			$data['txt_phone'] = $staff->Phone;
			$data['txt_phone'] = $staff->Phone;
			$data['txt_address'] = $staff->Address;
			$data['txt_usergroup'] = $staff->UserGroupID;
			$data['ch_status'] = $staff->Status;
			$data['txt_bio'] = $staff->Bio;
			$data['txt_avatar'] = $staff->Avatar;
		}
		if($this->input->post('crudaction') == "insert"){
			$this->form_validation->set_message('txt_fullname', 'Họ tên không được để trống');
			$this->form_validation->set_rules("txt_fullname", "Họ tên", "trim|required");

			if($userId == null){
				$this->form_validation->set_rules("txt_password", "Mật khẩu", "trim|required");
			}
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules('txt_phone', 'Số điện thoại', 'trim|required|regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number
			$this->form_validation->set_rules("txt_usergroup", "Nhóm người dùng", "required");
			$newAvatar = $this->uploadImage();
			if(isset($newAvatar) && !empty($newAvatar)){
				$data['txt_avatar'] = $newAvatar;
			} else {
				$data['txt_avatar'] = $this->input->post('txt_currentAvatar');
			}

			if ($this->form_validation->run()) {
				$count = $this->User_Model->checkExistUserNameAddGroup($phone, $userGroupID, $userId);
				if($count > 0){
					$data['error_message'] = 'Tên đăng nhập đã tồn tại.';
					$this->load->view('admin/user/add', $data);
				}else{
					$newdata['Us3rID'] = $userId;
					$newdata['fullname'] = $fullname;
					$newdata['password'] = $password;
					$newdata['email'] = $email;
					$newdata['phone'] = $phone;
					$newdata['address'] = $address;
					$newdata['status'] = $status;
					$newdata['bio'] = $bio;
					$newdata['avatar'] = $data['txt_avatar'];

					$this->User_Model->addNewUser($newdata, $userGroupID);
					if($userId != null){
						$this->session->set_flashdata('message_response', 'Cập nhật tài khoản tài khoản thành công');
					} else {
						$this->session->set_flashdata('message_response', 'Thêm tài khoản tài khoản thành công');
					}
					if($userGroupID == USER_GROUP_STAFF || $userGroupID == USER_GROUP_BROKER){
						redirect('admin/staff/list');
					} else {
						redirect('admin/user/list');
					}

				}
			}
		}

		$this->load->view("admin/user/add", $data);
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

	public function deleteUser(){
		$userId = $this->input->post('userId');
		if($userId != null){
			$this->User_Model->deleteByUserId($userId);
			echo json_encode(array('result' => true));
		} else {
			echo json_encode(array('result' => false));
		}
	}
}
