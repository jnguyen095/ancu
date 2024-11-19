<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 10/31/2017
 * Time: 5:16 PM
 */
class ProCode_controller extends CI_Controller
{
	private $allowed_img_types;
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			redirect('dang-nhap');
		}
		if($this->session->userdata('usergroup') != 'ADMIN'){
			redirect('/errors/html/error_404');
		}

		$this->load->library('session');
		$this->load->model('User_Model');
		$this->load->model('ProCode_Model');
		$this->load->library('pagination');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{
		$crudaction = $this->input->post("crudaction");
		if($crudaction == DELETE){
			$proCodeID = $this->input->post("proCodeID");
			$this->ProCode_Model->deleteById($proCodeID);
			$data['message_response'] = 'Xóa mã khuyến mãi thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/pro-code/list.html');

		$results = $this->ProCode_Model->findAndFilter($config['page'], $config['per_page']);
		$data['codes'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view("admin/procode/list", $data);
	}

	public function add($id = 0){
		$data = [];
		$data['ch_status'] = 1;
		$data['ch_onetime'] = "";
		$data['txt_code'] = "";
		$data['txt_about'] = "";
		$onemonth = strtotime('+1 months');
		$data['exp_date'] = date("d/m/Y", $onemonth);
		$data['ProCodeID'] = $this->input->post("proCodeID");
		$crudaction = $this->input->post("crudaction");
		if($crudaction == "insert"){
			$data['ch_status'] = $this->input->post("ch_status");
			$data['ch_onetime'] = ($this->input->post("ch_onetime") != null) ? $this->input->post("ch_onetime") : 0;
			$data['txt_code'] = $this->input->post("txt_code");
			$data['txt_about'] = $this->input->post("txt_about");
			$data['exp_date'] = $this->input->post("exp_date");
			$data['txt_type'] = $this->input->post("txt_type");

			$this->form_validation->set_rules("txt_type", "Loại mã khuyến mãi", "trim|required");
			$this->form_validation->set_rules("txt_code", "Mã khuyến mãi", "trim|required");
			if($this->form_validation->run()){
				$dbItems = $this->ProCode_Model->countByCode($data['txt_code'], $data['ProCodeID']);
				if($dbItems > 0){
					$data['error_message'] = "Mã khuyến mãi này bị trùng lắp dữ liệu, vui lòng chọn mã khác";
				} else{
					$id = $this->ProCode_Model->saveOrUpdate($data);
					if($id != null){
						redirect('admin/pro-code/list');
					}
				}
			}
		} else if($id > 0){
			$code = $this->ProCode_Model->findById($id);
			$data['proCodeID'] = $code->ProCodeID;
			$data['ch_status'] = $code->Status;
			$data['ch_onetime'] = $code->OneTime;
			$data['txt_code'] = $code->Code;
			$data['txt_about'] = $code->About;
			$data['exp_date'] = date('d/m/Y', strtotime($code->ExpiredDate));
			$data['txt_type'] = $code->Type;
		}
		$this->load->view("admin/procode/add", $data);
	}

	public function analytic($proCodeID){
		$config = pagination($this);
		$config['base_url'] = base_url('admin/pro-code/analytic-'.$proCodeID.'.html');

		$results = $this->ProCode_Model->findModelDetail($proCodeID, $config['page'], $config['per_page']);
		$data['proDetails'] = $results['details'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view("admin/procode/analytic", $data);

	}

	private function uploadImage(){
		if(!empty($this->input->post("txt_image"))){
			return $this->input->post("txt_image");
		}else{
			$this->allowed_img_types = $this->config->item('allowed_img_types');
			$upath = 'img' . DIRECTORY_SEPARATOR .'banner'. DIRECTORY_SEPARATOR;

			if (!file_exists($upath)) {
				mkdir($upath, 0777, true);
			}

			$config['upload_path'] = $upath;
			$config['allowed_types'] = $this->allowed_img_types;
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('txt_image')) {
				log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			}
			$img = $this->upload->data();
			return $img['file_name'];
		}
	}

	private function deleteBanner($bannerId){
		if($bannerId != null && $bannerId > 0) {
			$banner = $this->Banner_Model->findById($bannerId);
			$this->output->delete_cache($banner->Code);
			$imgFile = $banner->Image;
			$upath = 'img' . DIRECTORY_SEPARATOR .'banner'. DIRECTORY_SEPARATOR.$imgFile;
			// delete db first
			$this->Banner_Model->deleteById($bannerId);
			if (file_exists($upath)){
				unlink($upath);
			}
		}
	}
}
