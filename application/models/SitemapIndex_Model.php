<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 12/28/2017
 * Time: 11:13 AM
 */
class SitemapIndex_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function save($data){
		$this->db->insert('sitemapindex', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function searchByProperties($start, $limit){
		$query = $this->db->order_by('LastModified', 'desc')->get_where('sitemapindex', null, $limit, $start);
		$news = $query->result();

		$total = $this->db->count_all_results('sitemapindex');

		$data['sitemaps'] = $news;
		$data['total'] = $total;
		return $data;
	}

	public function findAll(){
		$query = $this->db->order_by('LastModified', 'desc')->get('sitemapindex');
		$sitemapindex = $query->result();
		return $sitemapindex;
	}

	public function updatePingDate(){
		$this->db->set('Ping', 'NOW()', false);
		return $this->db->update('sitemapindex');
	}

	public function deleteByIndexId($id){
		$this->db->delete('sitemapindex', array('SitemapIndexID' => $id));
		$this->db->delete('sitemap', array('SitemapIndexID' => $id));
	}

}
