<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_a_tour extends HOME_Controller
{

    public function __construct()
    {
        ob_start();
        parent::__construct();
        $this->load->database();
        $this->load->model("schedule_a_tour_model");
    }

    public function index()
    {
        $this->load->view("schedule-a-tour");
    }
    public function test_outlook(){
        $post_data = [
            "t_start_date_field"    => "03/28/2025",
            "t_time_slot"           => "2:00PM-1:00PM",
        ];
        $this->load->model('MsGraphModel');
            $t_start_date_field = date('m/d/Y', strtotime($post_data['t_start_date_field']));
            //i want to $t_start_date_field time format to Y-m-d\TH:i:s where i have timeslot in 12 hour format
            $time_slots = explode('-', $post_data['t_time_slot']);
            $start_time_raw = trim($time_slots[0]); // e.g., "12:21PM"
            $start_time_12h_formatted = date('H:i:s', strtotime($start_time_raw)); // Convert to 24-hour format
            $start_time = date('Y-m-d\TH:i:s', strtotime($t_start_date_field . ' ' . $start_time_12h_formatted));
            //endtime cannot be same as start time as am having 
            $end_time_raw = trim($time_slots[1]); // e.g., "12:21PM"
            $end_time_12h_formatted = date('H:i:s', strtotime($end_time_raw)); // Convert to 24-hour format
            $end_time = date('Y-m-d\TH:i:s', strtotime($t_start_date_field . ' ' . $end_time_12h_formatted));
            try{
                echo 12;
                print_r($this->MsGraphModel->createEvent("info@harvestgreenmontessori.com", "New tour schedule", $start_time, $end_time, "Test description"));
            }catch(Exception $e){
                echo 1;
                echo $e->getMessage();
            }
            
    }
    public function add_tour()
    {
        $this->load->library('form_validation');
    
        // Set validation rules
        $this->form_validation->set_rules('t_child_name_1', 'Child First Name', 'required|trim');
        $this->form_validation->set_rules('t_child_lname_1', 'Child Last Name', 'required|trim');
        $this->form_validation->set_rules('t_gender_1', 'Gender', 'required');
        $this->form_validation->set_rules('t_dob_1', 'Date of Birth', 'required');
        $this->form_validation->set_rules('t_class_1', 'Class', 'required');
        $this->form_validation->set_rules('t_address', 'Address', 'required|trim');
        $this->form_validation->set_rules('t_city', 'City', 'required|trim');
        $this->form_validation->set_rules('t_state', 'State', 'required|trim');
        $this->form_validation->set_rules('t_zip_code', 'Zip Code', 'required|numeric');
        $this->form_validation->set_rules('t_mother_name', 'Mother Name', 'required|trim');
        $this->form_validation->set_rules('t_mother_phone', 'Mother Phone', 'required|trim|numeric');
        $this->form_validation->set_rules('t_mother_email', 'Mother Email', 'required|valid_email');
        $this->form_validation->set_rules('t_father_name', 'Father Name', 'required|trim');
        $this->form_validation->set_rules('t_father_phone', 'Father Phone', 'required|trim|numeric');
        $this->form_validation->set_rules('t_father_email', 'Father Email', 'required|valid_email');
        $this->form_validation->set_rules('t_communication_method', 'Preferred Communication Method', 'required');
        $this->form_validation->set_rules('t_start_date_field', 'Preferred Start Date', 'required');
        $this->form_validation->set_rules('t_time_slot', 'Preferred Time Slot', 'required');
        $this->form_validation->set_rules('t_previous_school', 'Previous School', 'trim');
        $this->form_validation->set_rules('t_important_factors', 'Important Factors', 'trim');
        $this->form_validation->set_rules('t_source', 'How did you hear about us?', 'required');
        $this->form_validation->set_rules('t_program', 'Program of Interest', 'required');
        $this->form_validation->set_rules('t_referral_name', 'Referral Name', 'trim');
        $this->form_validation->set_rules('t_other_notes', 'Additional Notes', 'trim');
        $this->form_validation->set_rules('t_signature_date', 'Signature Date', 'required');
        $this->form_validation->set_rules('t_agegroup[]', 'Age Group', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
            return;
        }
    
        $post_data = $this->input->post();
    
        // Verify reCAPTCHA
        $recaptchaResponse = $post_data['g-recaptcha-response'] ?? '';
        $secretKey = '6Le72CQqAAAAACYyIJBOp45GHI1TcoqDl3M_04dX';
        $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $recaptchaUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "secret={$secretKey}&response={$recaptchaResponse}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $recaptchaResult = curl_exec($ch);
        curl_close($ch);
    
        $recaptchaData = json_decode($recaptchaResult);
    
        if (!$recaptchaData->success) {
            $this->session->set_flashdata('post_data', $_POST);
            $this->session->set_flashdata('msg', 'Please complete the reCAPTCHA verification.');
            $this->session->set_flashdata('head', 'Error');
            $this->session->set_flashdata('class', 'danger');
            redirect($_SERVER["HTTP_REFERER"]);
            return;
        }
    
        // Process Signature
        $t_signature = $this->input->post('t_signature');
        $file_name = null;
    
        if (!empty($t_signature)) {
            $t_signature = str_replace(['data:image/png;base64,', ' '], ['', '+'], $t_signature);
            $t_signature_data = base64_decode($t_signature);
            $file_name = 'signature_' . time() . '.png';
            $file_path = FCPATH . 'uploads/signatures/' . $file_name;
    
            if (!is_dir(FCPATH . 'uploads/signatures')) {
                mkdir(FCPATH . 'uploads/signatures', 0777, true);
            }
    
            file_put_contents($file_path, $t_signature_data);
        }
    
        $post_data['t_signature'] = $file_name;
        $t_agegroups = $this->input->post('t_agegroup', true);
        $post_data['t_agegroups'] = (!empty($t_agegroups) && is_array($t_agegroups)) ? implode(',', $t_agegroups) : 'N/A';
    
        $this->load->model("schedule_a_tour_model");
        $valid = $this->schedule_a_tour_model->add_tour($post_data);
    
        if ($valid) {
            $tour_id = $this->db->insert_id();
            $this->load->library('email'); // Get the last inserted ID
            $this->session->set_flashdata('timestamp', time());
    
            $parent_email = !empty($post_data['t_mother_email']) ? $post_data['t_mother_email'] : (!empty($post_data['t_father_email']) ? $post_data['t_father_email'] : $post_data['t_mail']);
    
            $email_data = array_merge($post_data, [
                't_signature' => !empty($post_data['t_signature']) ? base_url('uploads/signatures/' . $file_name) : 'N/A',
                'timestamp' => time(),
                'tour_id' => $tour_id // Include the tour ID in the email data
            ]);
    
            $email_template1 = $this->load->view('schedule_template', $email_data, true);
            $email_template2 = $this->load->view('thank_template', [
                'title' => 'Tour Confirmation',
                'name' => !empty($post_data['t_father_name']) ? $post_data['t_father_name'] : ($post_data['t_mother_name'] ?? 'N/A'),
                'phone' => !empty($post_data['t_father_phone']) ? $post_data['t_father_phone'] : ($post_data['t_mother_phone'] ?? 'N/A'),
                'address' => $post_data['t_address'] ?? 'N/A',
                'tour_id' => $tour_id
            ], true);
    
            $mail1 = ['adrs' => 'info@harvestgreenmontessori.com', 'sub' => 'Schedule A Tour Form Submission', 'body' => $email_template1];
            $mail2 = ['adrs' => $parent_email, 'sub' => 'Thank you for scheduling a tour at Harvest Green Montessori', 'body' => $email_template2];
    
            if ($this->send_mail($mail1) && $this->send_mail($mail2)) {
                $ics_filename = 'tour_event_' . time() . '.ics';
                $ics_content = $this->generate_ics_content($post_data);
                file_put_contents(FCPATH . 'uploads/ics/' . $ics_filename, $ics_content);

                // Attach ICS file to admin email
                $this->email->from('info@harvestgreenmontessori.com', 'Harvest Green Montessori');
                $this->email->to('info@harvestgreenmontessori.com');
                $this->email->subject('Tour Event Scheduled');
                $this->email->message('Please find the attached ICS file for the scheduled tour event.');
                $this->email->attach(FCPATH . 'uploads/ics/' . $ics_filename);

                // Send the email
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'Tour scheduled successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Error sending ICS file.');
                }
            }
    
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->session->set_flashdata('error', 'Failed to schedule the tour.');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

     // generate_ics_content function
     public function generate_ics_content($data)
     {
         $startDate      = $data['t_start_date_field'];
         $timeSlot       = $data['t_time_slot'];
         $address        = $data['t_address'];
         $child1_name = $data['t_child_name_1'];
         $child1_class = $data['t_class_1'];
 
         // Extract start and end times from the time slot
         [$startTime, $endTime] = explode('-', $timeSlot);
 
         $startDateTime = date("Y-m-d H:i:s", strtotime("$startDate $startTime"));
         $endDateTime   = date("Y-m-d H:i:s", strtotime("$startDate $endTime"));
 
         $start = gmdate("Ymd\THis\Z", strtotime($startDateTime));
         $end   = gmdate("Ymd\THis\Z", strtotime($endDateTime));
 
         // Build the ICS file content
         $ics_content = "BEGIN:VCALENDAR\r\n";
         $ics_content .= "PRODID:-//Harvest Green Montessori//NONSGML v1.0//EN\n";
         $ics_content .= "VERSION:2.0\r\n";
         $ics_content .= "BEGIN:VEVENT\r\n";
         $ics_content .= "DTSTART:$start\r\n";
         $ics_content .= "DTEND:$end\r\n";
         $ics_content .= "SUMMARY:Tour Event\r\n";
         $ics_content .= "DESCRIPTION:Tour scheduled for $child1_name and class $child1_class\r\n";
         $ics_content .= "LOCATION:$address\r\n";
         $ics_content .= "END:VEVENT\r\n";
         $ics_content .= "END:VCALENDAR\r\n";
 
         return $ics_content;
     }



    public function get_school_closed_events()
    {
        $this->db->select('event_start, event_end');
        $this->db->from('event');
        $this->db->where('event_type', 'School Closed');
        $data = $this->db->get();
        $events = $data->result();

        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'event_start' => date('d/m/Y', strtotime($event->event_start)),
                'event_end' => date('d/m/Y', strtotime($event->event_end))
            ];
        }

        echo json_encode($formattedEvents);
    }

    public function tourdetails($t_id)
    {
        $data['tour'] = $this->schedule_a_tour_model->get_tour_by_t_id($t_id);

        if (!$data['tour']) {
            show_404(); // Show 404 error if no tour is found
        }

        $this->load->view('reminder_tour_details', $data);
    }

    public function send_one_day_reminder()
    {
        date_default_timezone_set('America/Chicago');
        $tomorrow = date('m/d/Y', strtotime('+1 day'));
        $current_time = date('h:iA'); // AM/PM से पहले स्पेस नहीं रहेगा

        $this->db->select('*');
        $this->db->from('tour');
        $this->db->where('t_start_date_field', $tomorrow);
        $query = $this->db->get();
        $tours = $query->result();

        if (!empty($tours)) {
            foreach ($tours as $tour) {
                // Time slot से स्टार्ट टाइम निकालें
                $time_slots = explode('-', $tour->t_time_slot);
                $start_time_raw = trim($time_slots[0]); // e.g., "12:21PM"

                // टाइम को सही फॉर्मेट में कन्वर्ट करें (AM/PM के बिना स्पेस के)
                $start_time_12h_formatted = date('h:iA', strtotime($start_time_raw));

                // यदि अभी का समय `t_time_slot` के स्टार्ट टाइम के बराबर है तो ईमेल भेजें
                if ($start_time_12h_formatted == $current_time) {
                    $parent_email = !empty($tour->t_mother_email) ? $tour->t_mother_email : $tour->t_father_email;

                    if (!empty($parent_email)) {
                        $email_data = [
                            't_id' => $tour->t_id,
                            'name' => !empty($tour->t_father_name) ? $tour->t_father_name : ($tour->t_mother_name ?? 'Guest'),
                            'date' => date('d M, Y', strtotime($tour->t_start_date_field)),
                            'time' => $tour->t_time_slot,
                            'address' => $tour->t_address ?? 'N/A'
                        ];
                        $email_template = $this->load->view('reminder_template', $email_data, true);

                        $mail_data = [
                            'adrs' => $parent_email,
                            'sub' => 'Reminder: Your Tour is Scheduled for Tomorrow',
                            'body' => $email_template
                        ];
                        $this->send_mail($mail_data);
                    }
                }
            }
            echo "One-day reminder emails sent successfully!";
        }
    }

    public function send_one_hour_reminder()
    {
        date_default_timezone_set('America/Chicago');
        $current_date = date('m/d/Y');
        $current_time_plus_one_hour = date('h:i A', strtotime('+1 hour')); // 12-hour format with AM/PM
    
        $this->db->select('*');
        $this->db->from('tour');
        $this->db->where('t_start_date_field', $current_date);
        $query = $this->db->get();
        $tours = $query->result();
    
        if (!empty($tours)) {
            foreach ($tours as $tour) {
                $time_slots = explode('-', $tour->t_time_slot);
                $start_time_12h = trim($time_slots[0]); // e.g., "6:06PM"
    
                $start_time_12h_formatted = date('h:i A', strtotime($start_time_12h));
                
    
                if ($start_time_12h_formatted == $current_time_plus_one_hour) {
                    $parent_email = !empty($tour->t_mother_email) ? $tour->t_mother_email : $tour->t_father_email;
    
                    if (!empty($parent_email)) {
                        $email_data = [
                            't_id' => $tour->t_id,
                            'name' => !empty($tour->t_father_name) ? $tour->t_father_name : ($tour->t_mother_name ?? 'Guest'),
                            'date' => date('d M, Y', strtotime($tour->t_start_date_field)),
                            'time' => $tour->t_time_slot,
                            'address' => $tour->t_address ?? 'N/A'
                        ];
                        $email_template = $this->load->view('reminder_template', $email_data, true);
    
                        $mail_data = [
                            'adrs' => $parent_email,
                            'sub' => 'Reminder: Your Tour is Scheduled Soon',
                            'body' => $email_template
                        ];
                        $this->send_mail($mail_data);
                    }
                }
            }
            echo "Reminder emails sent successfully!";
        }
    }
    
    
}
