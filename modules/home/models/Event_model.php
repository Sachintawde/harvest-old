<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model
{



	public function __construct()

	{

		parent::__construct();
	}



	public function get_all_event()

	{

		$data = $this->db->get('event');

		$event = $data->result();

		return $event;
	}



	public function get_single_event($data)

	{

		$event_data = $this->db->get_where('event', $data);

		$event = $event_data->row_array();

		return $event;
	}



	public function getTotalRows()
	{

		$data = $this->db->get('event');

		$event = $data->num_rows();

		return $event;
	}



	public function get_event_name()
	{

		$query = $this->db->query("SELECT event_name FROM event GROUP BY event_name");

		$event_name = $query->result();

		return $event_name;
	}



	public function get_latest_event($event_id)

	{

		$this->db->from("event");

		$this->db->where("event_id!=", $event_id);

		$this->db->order_by('event_id', 'asc');

		$this->db->limit('4');

		$data = $this->db->get();

		$event = $data->result();

		return $event;
	}



	public function get_home_event()
	{
		$this->db->from("event");
		$this->db->where('MONTH(event_start)', date('m'));
		$this->db->where('YEAR(event_start)', date('Y'));
		$this->db->order_by('event_start', 'ASC');
		$data = $this->db->get();
		$event = $data->result();
		return $event;
	}






	public function get_event_daily()

	{

		$this->db->from("event");

		$this->db->where('DATE(event_start)>=CURDATE()');

		$this->db->order_by('event_start', 'asc');

		$this->db->limit('1');

		$data = $this->db->get();

		$event_daily = $data->result();

		return $event_daily;
	}
}
