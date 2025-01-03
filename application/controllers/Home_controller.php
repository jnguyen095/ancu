<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 7/20/2017
 * Time: 11:17 AM
 */
class Home_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
		$this->load->model('City_Model');
		$this->load->model('Brand_Model');
		$this->load->helper("seo_url");
		$this->load->helper('text');
		$this->load->helper("my_date");
		$this->load->model('News_Model');
		$this->load->model('Cooperate_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->model('Banner_Model');
		$this->load->helper('form');
	}

	public function index() {
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		$BANNER_HOME_1 = $this->cache->file->get('BANNER_HOME_1');
		$BANNER_HOME_2 = $this->cache->file->get('BANNER_HOME_2');
		$BANNER_HOME_4 = $this->cache->file->get('BANNER_HOME_4');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		if(!$BANNER_HOME_1){
			$BANNER_HOME_1 = $this->Banner_Model->loadByCode('BANNER_HOME_1');
			$this->cache->file->save('BANNER_HOME_1', $BANNER_HOME_1, 1440);
		}
		if(!$BANNER_HOME_2){
			$BANNER_HOME_2 = $this->Banner_Model->loadByCode('BANNER_HOME_2');
			$this->cache->file->save('BANNER_HOME_1', $BANNER_HOME_2, 1440);
		}
		if(!$BANNER_HOME_4){
			$BANNER_HOME_4 = $this->Banner_Model->loadByCode('BANNER_HOME_4');
			$this->cache->file->save('BANNER_HOME_4', $BANNER_HOME_4, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;
		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;

		// $data['hotProducts'] = $this->Product_Model->findByHotProduct();
		$data['nhadatban'] = $this->Product_Model->findByCategoryCode(NHADAT_BAN, 0, 10);
		$data['nhadatchothue'] = $this->Product_Model->findByCategoryCode(NHADAT_CHOTHUE, 0, 10);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);
		$data['hotBranches'] = $this->Brand_Model->findTopBranchHasProductAndDataAuto(4);
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 6);
		$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 10);
		$data['underOneBillion'] = $this->Product_Model->findUnderOneBillion(0, 8);
		$data['justUpdates'] = $this->Product_Model->findJustUpdate(0, 8);
		// $data['cooperates'] = $this->Cooperate_Model->findTopLatest(3);
		$data['BANNER_HOME_1'] = $BANNER_HOME_1;
		$data['BANNER_HOME_2'] = $BANNER_HOME_2;
		$data['BANNER_HOME_4'] = $BANNER_HOME_4;
		$this->load->helper('url');
		$this->load->view('Home_view', $data);
	}

}
