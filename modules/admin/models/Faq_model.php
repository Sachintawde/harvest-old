<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_faq()
	{
		$this->db->order_by('faq_order', 'ASC');
		$data = $this->db->get('faq');
		return $data->result();
	}

	public function get_single_faq($data)
	{
		$faq_data = $this->db->get_where('faq', $data);
		return $faq_data->row_array();
	}

	public function add_faq($row)
	{
		$valid = array();

		$data = array(
			'faq_question'   => $row['faq_question'],
			'faq_answer'     => $row['faq_answer'],
			'faq_order'      => isset($row['faq_order']) ? (int)$row['faq_order'] : 0,
			'faq_bg_color'   => isset($row['faq_bg_color'])    && $row['faq_bg_color']    !== '' ? $row['faq_bg_color']    : '#f7f7f7',
			'faq_title_color'=> isset($row['faq_title_color']) && $row['faq_title_color'] !== '' ? $row['faq_title_color'] : '#3d3d3d',
			'faq_status'     => 1,
			'faq_date'       => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert('faq', $data);

		if ($query) {
			$valid['status']   = 'success';
			$valid['messages'] = 'FAQ added successfully';
		} else {
			$valid['status']   = 'warning';
			$valid['messages'] = 'Could not add FAQ';
		}

		return $valid;
	}

	public function edit_faq($row)
	{
		$valid = array();

		$data = array(
			'faq_question'   => $row['faq_question'],
			'faq_answer'     => $row['faq_answer'],
			'faq_order'      => isset($row['faq_order']) ? (int)$row['faq_order'] : 0,
			'faq_bg_color'   => isset($row['faq_bg_color'])    && $row['faq_bg_color']    !== '' ? $row['faq_bg_color']    : '#f7f7f7',
			'faq_title_color'=> isset($row['faq_title_color']) && $row['faq_title_color'] !== '' ? $row['faq_title_color'] : '#3d3d3d',
		);

		$query = $this->db->update('faq', $data, array('faq_id' => (int)$row['faq_id']));

		if ($query) {
			$valid['status']   = 'success';
			$valid['messages'] = 'FAQ updated successfully';
		} else {
			$valid['status']   = 'warning';
			$valid['messages'] = 'Could not update FAQ';
		}

		return $valid;
	}

	public function update_status($row)
	{
		$valid = array();

		$query = $this->db->update('faq', array('faq_status' => (int)$row['faq_status']), array('faq_id' => (int)$row['faq_id']));

		if ($query) {
			$valid['status']   = 'success';
			$valid['messages'] = 'Status updated successfully';
		} else {
			$valid['status']   = 'warning';
			$valid['messages'] = 'Could not update status';
		}

		return $valid;
	}

	public function remove_faq($data)
	{
		$valid = array();

		$query = $this->db->delete('faq', array('faq_id' => (int)$data['faq_id']));

		if ($query) {
			$valid['status']   = 'success';
			$valid['messages'] = 'FAQ deleted successfully';
		} else {
			$valid['status']   = 'warning';
			$valid['messages'] = 'Could not delete FAQ';
		}

		return $valid;
	}
}
