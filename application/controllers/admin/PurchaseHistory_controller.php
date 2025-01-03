<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 12/8/2017
 * Time: 3:08 PM
 */
class PurchaseHistory_controller extends CI_Controller
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
		$this->load->model('PurchaseHistory_Model');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/purchase-history/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "TransferTime";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->PurchaseHistory_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['histories'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/purchasehistory/list", $data);
	}
}
