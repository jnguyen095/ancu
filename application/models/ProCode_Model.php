<?php

/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 12/08/2018
 * Time: 4:01 PM
 */
class ProCode_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function saveOrUpdate($data)
	{
		$expDate = DateTime::createFromFormat("d/m/Y", $data['exp_date']);
		$id = $data['ProCodeID'];
		if($id == null){
			$newdata = array(
				'Code' => $data['txt_code'],
				'Type' => $data['txt_type'],
				'Status' => $data['ch_status'],
				'OneTime' => $data['ch_onetime'],
				'About' => $data['txt_about'],
				'Involved' => 0,
				'CreatedDate' => date('Y-m-d H:i:s'),
				'ExpiredDate' => $expDate->format('Y-m-d')
			);
			// Create new
			$this->db->insert('ProCode', $newdata);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}else{
			$newdata = array(
				'Code' => $data['txt_code'],
				'Type' => $data['txt_type'],
				'Status' => $data['ch_status'],
				'OneTime' => $data['ch_onetime'],
				'About' => $data['txt_about'],
				'ExpiredDate' => $expDate->format('Y-m-d')
			);
			$this->db->where('ProCodeID', $id);
			$this->db->update('ProCode', $newdata);
			return $data['ProCodeID'];
		}
	}

	function insertIntoStatistic($userId, $proCode){
		$proCodeId = $this->db->select('ProCodeID')
			->from('ProCode')
			->where('Code', $proCode)
			->get()->row()->ProCodeID;

		$data = array(
			'ProCodeID' => $proCodeId,
			'UserID' => $userId,
			'CreatedDate' => date('Y-m-d H:i:s')
		);
		$this->db->insert('ProCodeStatistic', $data);
		$this->updateInvolved($proCodeId);
	}

	function updateInvolved($proCodeId){
		$this->db->set('Involved', 'Involved + 1', false);
		$this->db->where('ProCodeID', $proCodeId);
		$this->db->update('ProCode');
	}

	function findAndFilter($offset, $limit){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('bn.*')
			->from('ProCode bn')
			->limit($limit, $offset)
			->get();

		$result['items'] = $query->result();

		$query = $this->db->get('ProCode');
		$result['total'] = $query->num_rows();

		return $result;
	}

	public function findById($codeId) {
		$this->db->where(array("ProCodeID" => $codeId));
		$query = $this->db->get("ProCode");
		$code = $query->row();
		return $code;
	}

	function countByCode($code, $id=null){
		$this->db->where(array("Code" => $code));
		if($id > 0){
			$this->db->where("ProCodeID != ", $id, FALSE);
		}

		$num = $this->db->count_all_results("ProCode");
		return $num;
	}

	function countIfValidCode($code, $type){
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d ');
		$this->db->where(array("Code" => $code, "Type" => $type, "Status" => 1, "ExpiredDate >=" => $curr_date));
		$num = $this->db->count_all_results("ProCode");
		return $num;
	}

	function findModelDetail($proCodeId, $page, $per_page){
		$query = $this->db->select('u.FullName, s.CreatedDate')
			->from('ProCodeStatistic s')
			->join('ProCode p', 'p.ProCodeID = s.ProCodeID')
			->join('us3r u', 'u.us3rID = s.UserID')
			->where('p.ProCodeID', $proCodeId)
			->limit($per_page, $page)
			->get();

		$data = [];
		$data['details'] = $query->result();

		$this->db->where(array("ProCodeID" => $proCodeId));
		$total = $this->db->count_all_results('ProCodeStatistic');
		$data['total'] = $total;

		return $data;
	}

	function deleteById($proCodeId){
		$this->db->delete('ProCode', array('ProCodeID' => $proCodeId));
	}
}
