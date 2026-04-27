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

            't_time_slot'        => $row['t_time_slot'],

            't_status'           => 1,   // only count active (non-deleted) bookings

        );

        $check_slot = $this->db->get_where('tour', $where1)->num_rows();

        $phone_norm = preg_replace('/\D/', '', trim($row['t_mother_phone'] ?? ''));
        $where2 = array(
            't_start_date_field' => $row['t_start_date_field'],
            't_mother_phone'     => $phone_norm,
            't_status'           => 1,
        );
        $check_mob = $this->db->get_where('tour', $where2)->num_rows();

        $email_norm = strtolower(trim($row['t_mother_email'] ?? ''));
        $check_email = 0;
        if (!empty($email_norm)) {
            $check_email = $this->db
                ->where('t_start_date_field', $row['t_start_date_field'])
                ->where('t_mother_email', $email_norm)
                ->where('t_status', 1)
                ->count_all_results('tour');
        }

        if ($check_slot) {
            $this->session->set_flashdata('post_data', $row);
            $this->session->set_flashdata('error', 'The ' . ($row['t_time_slot'] ?? 'selected') . ' slot is already booked for that date. Please choose another time.');
            $valid = false;
        } elseif ($check_mob) {
            $this->session->set_flashdata('post_data', $row);
            $this->session->set_flashdata('error', 'You have already booked a tour for this date using this phone number. Please select a different date.');
            $valid = false;
        } elseif ($check_email) {
            $this->session->set_flashdata('post_data', $row);
            $this->session->set_flashdata('error', 'You have already booked a tour for this date using this email address. Please select a different date.');
            $valid = false;
        } else {
            // Handling Signature Upload
            $file_name = isset($row['signature']) ? $row['signature'] : 'default_signature.png';

            $data = array(
                't_child_name_1'         => $row['t_child_name_1']         ?? '',
                't_child_lname_1'        => $row['t_child_lname_1']        ?? '',
                't_gender_1'             => $row['t_gender_1']             ?? '',
                't_dob_1'                => $row['t_dob_1']                ?? '',
                't_class_1'              => $row['t_class_1']              ?? '',
                't_child_name_2'         => $row['t_child_name_2']         ?? '',
                't_child_lname_2'        => $row['t_child_lname_2']        ?? '',
                't_gender_2'             => $row['t_gender_2']             ?? '',
                't_dob_2'                => $row['t_dob_2']                ?? '',
                't_class_2'              => $row['t_class_2']              ?? '',
                't_address'              => $row['t_address']              ?? '',
                't_city'                 => $row['t_city']                 ?? '',
                't_state'                => $row['t_state']                ?? '',
                't_zip_code'             => $row['t_zip_code']             ?? '',
                't_mother_name'          => $row['t_mother_name']          ?? '',
                't_mother_phone'         => $row['t_mother_phone']         ?? '',
                't_mother_email'         => $row['t_mother_email']         ?? '',
                't_father_name'          => $row['t_father_name']          ?? '',
                't_father_phone'         => $row['t_father_phone']         ?? '',
                't_father_email'         => $row['t_father_email']         ?? '',
                't_communication_method' => $row['t_communication_method'] ?? 'phone',
                't_start_date_field'     => $row['t_start_date_field']     ?? '',
                't_time_slot'            => $row['t_time_slot']            ?? '',
                't_previous_school'      => $row['t_previous_school']      ?? '',
                't_important_factors'    => $row['t_important_factors']    ?? '',
                't_source'               => $row['t_source']               ?? '',
                't_program'              => $row['t_program']              ?? '',
                't_referral_name'        => $row['t_referral_name']        ?? '',
                't_other_notes'          => $row['t_other_notes']          ?? '',
                't_signature_date'       => $row['t_signature_date']       ?? '',
                't_agegroups'            => $row['t_agegroups']            ?? ($row['t_program'] ?? ''),
                't_signature'            => $row['t_signature']            ?? '',
                't_date'                 => date('Y-m-d H:i:s')
            );

            $query = $this->db->insert('tour', $data);

            if ($query) {
                $valid = true;
                $this->session->set_flashdata(array(
                    'class' => 'success',
                    'head'  => 'Success',
                    'msg'   => "Thank you, " . ($row['t_mother_name'] ?? 'there') . "! We have received your tour request and will be in touch shortly."
                ));
            } else {
                $valid = false;
                $this->session->set_flashdata('post_data', $row);
                $this->session->set_flashdata('error', "We couldn't save your tour request. Please try again later.");
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
        return $this->db->get_where('tour', ['t_id' => $t_id, 't_status' => 1])->row_array();
    }

    /**
     * Return all booked time slots for a given date (active bookings only).
     * Used by the frontend to disable already-taken slots.
     *
     * @param  string $date  Format: mm/dd/yyyy
     * @return string[]      Array of time slot strings
     */
    public function get_booked_slots_for_date($date)
    {
        $this->db->select('t_time_slot');
        $this->db->from('tour');
        $this->db->where('t_start_date_field', $date);
        $this->db->where('t_status', 1);
        $query = $this->db->get();
        return array_column($query->result_array(), 't_time_slot');
    }
}
// model end here