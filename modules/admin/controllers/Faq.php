<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends ADMIN_Controller {

	public function __construct()
	{
		ob_start();
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('faq');
	}

	public function get_all_faq()
	{
		$this->load->model('faq_model');
		$faqs = $this->faq_model->get_all_faq();
		$output = array('data' => array());

		foreach ($faqs as $row) {
			$faq_id = $row->faq_id;

			$status_badge = $row->faq_status == 1
				? '<span class="label label-success">Active</span>'
				: '<span class="label label-danger">Inactive</span>';

			$button = '<div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#editFaqModal" onclick="editFaq(' . $faq_id . ')"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeFaqModal" onclick="removeFaq(' . $faq_id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>
              </ul>
            </div>';

			$output['data'][] = array(
				$row->faq_order,
				htmlspecialchars($row->faq_question, ENT_QUOTES, 'UTF-8'),
				htmlspecialchars(strip_tags($row->faq_answer), ENT_QUOTES, 'UTF-8'),
				$status_badge,
				date('m-d-Y', strtotime($row->faq_date)),
				$button
			);
		}

		echo json_encode($output);
	}

	public function get_single_faq()
	{
		$data['faq_id'] = (int)$this->input->post('faq_id');
		$this->load->model('faq_model');
		$d = $this->faq_model->get_single_faq($data);
		echo json_encode($d);
	}

	public function add_faq()
	{
		$post_data = $this->input->post();
		$this->load->model('faq_model');
		$d = $this->faq_model->add_faq($post_data);
		echo json_encode($d);
	}

	public function edit_faq()
	{
		$post_data = $this->input->post();
		$this->load->model('faq_model');
		$d = $this->faq_model->edit_faq($post_data);
		echo json_encode($d);
	}

	public function update_status()
	{
		$post_data = $this->input->post();
		$this->load->model('faq_model');
		$d = $this->faq_model->update_status($post_data);
		echo json_encode($d);
	}

	public function remove_faq()
	{
		$data['faq_id'] = (int)$this->input->post('faq_id');
		$this->load->model('faq_model');
		$d = $this->faq_model->remove_faq($data);
		echo json_encode($d);
	}
}
