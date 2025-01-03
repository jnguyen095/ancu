<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 7/20/2017
 * Time: 11:27 AM
 */
class Product_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
		$this->load->model('City_Model');
		$this->load->model('District_Model');
		$this->load->model('News_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->model('Brand_Model');
		$this->load->model('Banner_Model');
		$this->load->helper("seo_url");
		$this->load->helper("my_date");
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
		$this->load->helper('form');
	}

	public function listItem($catId, $offset=0) {
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

		$search_data = $this->Product_Model->findByCatIdFetchAddress($catId, $offset, MAX_PAGE_ITEM);


		$data = array_merge($data, $search_data);

		$thisCat = $this->Category_Model->findById($catId);
		$data['category'] = $thisCat;
		$data['sameLevels'] = $this->Category_Model->findByParentId($thisCat->ParentID, $catId);

		$config = pagination();
		$config['base_url'] = base_url(seo_url($data['category']->CatName).'-c'.$catId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['cityWithCats'] = $this->City_Model->findCityByCategoryId($catId);

		$BANNER_CAT_1 = $this->cache->file->get('BANNER_CAT_1');
		if(!$BANNER_CAT_1){
			$BANNER_CAT_1 = $this->Banner_Model->loadByCode('BANNER_CAT_1');
			$this->cache->file->save('BANNER_CAT_1', $BANNER_CAT_1, 1440);
		}
		$data['BANNER_CAT_1'] = $BANNER_CAT_1;

		$this->load->helper('url');
		$this->load->view('product/Product_list', $data);
	}

	public function detailItem($productId) {
		$product = $this->Product_Model->findByIdFetchAll($productId);
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

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;

		if(!isset($product) || $product->ProductID == null){
			// redirect("/khong-tim-thay");
			$this->load->view('Notfound_view', $data);
		}else {
			$product = $this->Product_Model->findByIdFetchAll($productId);
			$category = $this->Category_Model->findById($product->CategoryID);
			$data['category'] = $category;
			$data['product'] = $product;
			$data['district'] = $this->District_Model->findById($product->DistrictID);
			$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 5);
			if ($product->DistrictID != null) {
				$similarPros = $this->Product_Model->findByCatIdAndDistrictIdFetchAddressNotCurrent($product->CategoryID, $product->DistrictID, 10, $productId);
				if (count($similarPros) % 2 != 0) {
					unset($similarPros[0]);
				}
				$data['similarProducts'] = $similarPros;
				if (count($similarPros) < 1) {
					$similarCityPros = $this->Product_Model->findByCatIdAndCityIdFetchAddressNotCurrent($product->CategoryID, $product->CityID, 10, $productId);
					if (count($similarCityPros) % 2 != 0) {
						unset($similarCityPros[0]);
					}
					$data['similarCityProducts'] = $similarCityPros;
					$data['city'] = $this->City_Model->findById($product->CityID);
				}
			}
			if ($product->BrandID != null) {
				$data['branch'] = $this->Brand_Model->findByIdHasImage($product->BrandID);
			}

			$this->Product_Model->updateViewForProductId($productId);
			if ($product->CreatedByID != null && $product->CreatedByID > 0) {
				$data['totalProductWithThisUser'] = $this->Product_Model->countProductWithUser($product->CreatedByID);
			}

			$this->load->helper('url');

			//load the same parent category
			$data['sameLevels'] = $this->Category_Model->findByParentId($category->ParentID, $category->CategoryID);

			$BANNER_DETAIL_1 = $this->cache->file->get('BANNER_DETAIL_1');
			if(!$BANNER_DETAIL_1){
				$BANNER_DETAIL_1 = $this->Banner_Model->loadByCode('BANNER_DETAIL_1');
				$this->cache->file->save('BANNER_DETAIL_1', $BANNER_DETAIL_1, 1440);
			}
			$data['BANNER_DETAIL_1'] = $BANNER_DETAIL_1;

			$this->load->view('product/Product_detail', $data);
		}
	}

	public function justUpdateItems($offset=0) {
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

		$totalProduct = $this->Product_Model->countAllProduct();
		$justUpdateItems = $this->Product_Model->findJustUpdate($offset, MAX_PAGE_ITEM);
		$data['products'] = $justUpdateItems;

		$config = pagination();
		$config['base_url'] = base_url('/bat-dong-san-moi-cap-nhat.html');
		$config['total_rows'] = $totalProduct;
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);

		$this->load->helper('url');
		$this->load->view('product/Product_just_update', $data);
	}

	public function underOneBillion($offset=0){
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

		$totalProduct = $this->Product_Model->countProductUnderOneBillion();
		$underOneBillionItems = $this->Product_Model->findUnderOneBillion($offset, MAX_PAGE_ITEM);
		$data['products'] = $underOneBillionItems;

		$config = pagination();
		$config['base_url'] = base_url('/nha-dat-duoi-mot-ty.html');
		$config['total_rows'] = $totalProduct;
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);

		$this->load->helper('url');
		$this->load->view('product/Product_under_one_billion', $data);
	}
}
