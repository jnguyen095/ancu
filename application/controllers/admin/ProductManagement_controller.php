<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 10/3/2017
 * Time: 10:25 AM
 */
class ProductManagement_controller extends CI_Controller
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

		$this->load->library('session');
		$this->load->model('Product_Model');
		$this->load->model('Category_Model');
		$this->load->model('User_Model');
		$this->load->model('Unit_Model');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$crudaction = $this->input->post("crudaction");
		if($crudaction == DELETE){
			$productId = $this->input->post("productId");
			$this->deleteProductById($productId);
			$data['message_response'] = 'Xóa tin rao thành công.';
		}else if($crudaction == "delete-multiple"){
			$productIds = $this->input->post("checkList");
			foreach ($productIds as $productId){
				$this->deleteProductById($productId);
			}
			$data['message_response'] = 'Xóa tin rao thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/product/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "ModifiedDate";
			$config['orderDirection'] = "DESC";
		}
		$postFromDate = $this->input->get('fromDate');
		$postToDate = $this->input->get('toDate');
		$phoneNumber = $this->input->get('phoneNumber');
		$createdById = $this->input->get('createdById');
		$hasAuthor = $this->input->get('hasAuthor');
		$status = $this->input->get('status');
		$code = $this->input->get('code');
		if($phoneNumber != null && count($phoneNumber) > 0){
			$results = $this->Product_Model->findByPhoneNumber($config['page'], $config['per_page'], $phoneNumber);
			$data['products'] = $results['items'];
			$config['total_rows'] = $results['total'];
		}else {
			$results = $this->Product_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $postFromDate, $postToDate, $createdById, $hasAuthor, $code, $status, $config['orderField'], $config['orderDirection']);
			$data['products'] = $results['items'];
			$config['total_rows'] = $results['total'];
		}
		if($createdById != null){
			$user = $this->User_Model->getUserById($createdById);
			$data['user'] = $user;
		}

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/product/list", $data);
	}

	public function edit(){
		$productId = $this->input->get("postId");
		$categories = $this->Category_Model->getCategories();

		$product = $this->Product_Model->findById($productId);
		$data = $categories;
		$data['product'] = $product;
		$data['units'] = $this->Unit_Model->findAll();
		$this->load->view("admin/product/edit", $data);
	}

	private function deleteProductById($productId){
		if($productId != null && $productId > 0) {
			$product = $this->Product_Model->findById($productId);
			$folder = $product->code;
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $product->CreatedByID . DIRECTORY_SEPARATOR. $folder;
			// delete db first
			$this->Product_Model->deleteById($productId);
			if (file_exists($upath)){
				$this->delete_directory($upath);
			}
		}
	}

	public function pushPostUp(){
		$productId = $this->input->post('productId');
		$this->Product_Model->pushPostUp($productId);
		echo json_encode('success');
	}

	private function delete_directory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				else
					delete_directory($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
}
