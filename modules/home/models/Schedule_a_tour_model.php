<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Schedule_a_tour_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_tour($row)
    {
        $valid = false;

        $where1 = array(

            't_start_date_field' => $row['t_start_date_field'],

            't_time_slot' => $row['t_time_slot']

        );

        $check_slot = $this->db->get_where('tour', $where1)->num_rows();
        $where2 = array(

            't_start_date_field' => $row['t_start_date_field'],

            't_father_phone' => $row['t_father_phone'],
            't_mother_phone' => $row['t_mother_phone']

        );

        $check_mob = $this->db->get_where('tour', $where2)->num_rows();

        if ($check_slot) {

            $this->session->set_flashdata('post_data', $row);

            $this->session->set_flashdata('class', 'danger');

            $this->session->set_flashdata('head', 'Error');

            $this->session->set_flashdata('msg', "Sorry " . $row['t_time'] . " slot is already booked on same date, please try another slot");

            $valid = false;
        } elseif ($check_mob) {

            $this->session->set_flashdata('post_data', $row);

            $this->session->set_flashdata('class', 'danger');

            $this->session->set_flashdata('head', 'Error');

            $this->session->set_flashdata('msg', "Sorry " . $row['t_mob'] . ", sorry you have already booked a slot on same date, please select another date");

            $valid = false;
        } else {
            // Handling Signature Upload
            $file_name = isset($row['signature']) ? $row['signature'] : 'default_signature.png';

            $data = array(
                't_child_name_1' => $row['t_child_name_1'],
                't_child_lname_1' => $row['t_child_lname_1'],
                't_gender_1' => $row['t_gender_1'],
                't_dob_1' => $row['t_dob_1'],
                't_class_1' => $row['t_class_1'],
                't_child_name_2' => $row['t_child_name_2'],
                't_child_lname_2' => $row['t_child_lname_2'],
                't_gender_2' => $row['t_gender_2'],
                't_dob_2' => $row['t_dob_2'],
                't_class_2' => $row['t_class_2'],
                't_address' => $row['t_address'],
                't_city' => $row['t_city'],
                't_state' => $row['t_state'],
                't_zip_code' => $row['t_zip_code'],
                't_mother_name' => $row['t_mother_name'],
                't_mother_phone' => $row['t_mother_phone'],
                't_mother_email' => $row['t_mother_email'],
                't_father_name' => $row['t_father_name'],
                't_father_phone' => $row['t_father_phone'],
                't_father_email' => $row['t_father_email'],
                't_communication_method' => $row['t_communication_method'],
                't_start_date_field' => $row['t_start_date_field'],
                't_time_slot' => $row['t_time_slot'],
                't_previous_school' => $row['t_previous_school'],
                't_important_factors' => $row['t_important_factors'],
                't_source' => $row['t_source'],
                't_program' => $row['t_program'],
                't_referral_name' => $row['t_referral_name'],
                't_other_notes' => $row['t_other_notes'],
                't_signature_date' => $row['t_signature_date'],
                't_agegroups' => implode(',', $this->input->post('t_agegroup', true) ?? []),
                't_signature' => base_url('uploads/signatures/' . $file_name),
                't_date' => date('Y-m-d H:i:s')
            );

            $query = $this->db->insert('tour', $data);

            if ($query) {
                $valid = true;
                $this->session->set_flashdata(array(
                    'class' => 'success',
                    'head' => 'Success',
                    'msg' => "Thank you, " . $row['t_mother_name'] . " and " . $row['t_father_name'] . ", for contacting us! We will get in touch with you shortly."
                ));
            } else {
                $valid = false;
                $this->session->set_flashdata('post_data', $row);
                $this->session->set_flashdata('class', 'danger');
                $this->session->set_flashdata('head', 'Error');
                $this->session->set_flashdata('msg', "Sorry, we can't process your request at this time. Please try again later.");
            }
        }

        return $valid;
    }

    public function get_upcoming_tours()
    {
        $this->db->select('t_fname, t_mail, t_sdate, t_time');
        $this->db->from('schedule_tour');
        $this->db->where('t_sdate >=', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }


    public function get_tour_by_t_id($t_id)
    {
        return $this->db->get_where('tour', ['t_id' => $t_id])->row_array();
    }
}
// model end here