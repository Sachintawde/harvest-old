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
        // Generate a one-time form token and record page-load time for anti-spam checks
        $this->session->set_userdata('tour_form_token', bin2hex(random_bytes(32)));
        $this->session->set_userdata('tour_form_loaded', time());
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
    public function test_mail()
    {
        $this->load->helper('env');

        $html  = '<style>body{font-family:monospace;background:#0d1117;color:#c9d1d9;padding:20px}'
               . 'h2{color:#58a6ff}h3{color:#e3b341;margin:0 0 12px}'
               . '.ok{color:#3fb950}.fail{color:#f85149}.warn{color:#d29922}'
               . 'pre{background:#161b22;padding:12px;border-radius:6px;overflow:auto;font-size:12px;white-space:pre-wrap}'
               . 'table{border-collapse:collapse;width:100%;margin-bottom:12px}'
               . 'td,th{border:1px solid #30363d;padding:8px 12px}th{background:#21262d}'
               . '.box{border:1px solid #30363d;border-radius:6px;padding:16px 20px;margin-bottom:20px}</style>';
        $html .= '<h2>Microsoft Graph Mail Diagnostic &mdash; Harvest Green Montessori</h2>';
        $html .= '<p>Environment: <strong>' . ENVIRONMENT . '</strong> &nbsp;|&nbsp; PHP: ' . phpversion()
               . ' &nbsp;|&nbsp; OS: ' . PHP_OS . ' &nbsp;|&nbsp; ' . date('Y-m-d H:i:s') . ' (server time)</p>';

        $from  = env('MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        $admin = env('ADMIN_MAIL_TO',     'info@harvestgreenmontessori.com');

        // ── Graph API env vars ────────────────────────────────────────────────
        $html .= '<div class="box"><h3>&#9312; Microsoft Graph Configuration</h3>';
        $env_keys = ['MS_GRAPH_TENANT_ID', 'MS_GRAPH_CLIENT_ID', 'MS_GRAPH_CLIENT_SECRET', 'MAIL_FROM_ADDRESS', 'ADMIN_MAIL_TO'];
        $html .= '<table>';
        foreach ($env_keys as $k) {
            $v = getenv($k);
            if ($k === 'MS_GRAPH_CLIENT_SECRET' && $v) {
                $display = str_repeat('*', max(0, strlen($v) - 4)) . substr($v, -4);
            } else {
                $display = $v !== false ? htmlspecialchars($v) : '<span class="warn">NOT SET</span>';
            }
            $html .= '<tr><td>' . $k . '</td><td>' . $display . '</td></tr>';
        }
        $html .= '</table></div>';

        // ── Test 1: Send to admin ─────────────────────────────────────────────
        $html .= '<div class="box"><h3>&#9313; Test Send &rarr; Admin (' . htmlspecialchars($admin) . ')</h3>';
        $sent1 = $this->send_mail([
            'adrs' => $admin,
            'sub'  => '[TEST] Graph API Diagnostic — ' . date('Y-m-d H:i:s'),
            'body' => '<p>Graph API diagnostic test sent to admin at ' . date('Y-m-d H:i:s') . '</p>',
        ]);
        $html .= $sent1 ? '<p class="ok">&#10004; SENT &rarr; ' . htmlspecialchars($admin) . '</p>'
                        : '<p class="fail">&#10008; FAILED &rarr; ' . htmlspecialchars($admin) . ' (check application/logs)</p>';
        $html .= '</div>';

        // ── Test 2: Send to ?to= param ────────────────────────────────────────
        $extra_to_raw = $this->input->get('to');
        $extra_to     = (!empty($extra_to_raw) && filter_var($extra_to_raw, FILTER_VALIDATE_EMAIL))
                        ? $extra_to_raw : 'sachintawde548@gmail.com';
        $html .= '<div class="box"><h3>&#9314; Test Send &rarr; External (' . htmlspecialchars($extra_to) . ')</h3>';
        $sent2 = $this->send_mail([
            'adrs' => $extra_to,
            'sub'  => '[TEST] Graph API Diagnostic — ' . date('Y-m-d H:i:s'),
            'body' => '<p>Graph API diagnostic test sent to ' . htmlspecialchars($extra_to) . ' at ' . date('Y-m-d H:i:s') . '</p>',
        ]);
        $html .= $sent2 ? '<p class="ok">&#10004; SENT &rarr; ' . htmlspecialchars($extra_to) . '</p>'
                        : '<p class="fail">&#10008; FAILED &rarr; ' . htmlspecialchars($extra_to) . ' (check application/logs)</p>';
        $html .= '</div>';

        $html .= '<p style="color:#8b949e;font-size:11px">&#9888; Remove or protect this endpoint before leaving in production.</p>';
        $this->output->set_header('Cache-Control: no-store, no-cache');
        $this->output->set_content_type('text/html', 'utf-8');
        echo $html;
    }

    // ── Private: IP-based rate limiter (max 5 tour submissions per hour) ────────
    private function _tour_ip_rate_ok()
    {
        $ip     = $this->input->ip_address();
        $file   = APPPATH . 'cache/tour_rl_' . md5($ip) . '.json';
        $limit  = 5;
        $window = 3600;
        $now    = time();

        $data = ['count' => 0, 'window_start' => $now];
        if (file_exists($file)) {
            $stored = json_decode(file_get_contents($file), true);
            if (is_array($stored) && ($now - (int) $stored['window_start']) < $window) {
                $data = $stored;
            }
        }

        if ((int) $data['count'] >= $limit) {
            return false;
        }

        $data['count'] = (int) $data['count'] + 1;
        @file_put_contents($file, json_encode($data), LOCK_EX);
        return true;
    }

    public function add_tour()
    {
        // ── Layer 1: Honeypot – must be empty; bots fill it ──────────────────────
        if (!empty($this->input->post('website'))) {
            // Silent redirect – do not reveal why, so bots cannot adapt
            redirect(base_url('schedule_a_tour'));
            return;
        }

        // ── Layer 2: One-time form token (CSRF-style) ────────────────────────────
        $expected_token  = (string) $this->session->userdata('tour_form_token');
        $submitted_token = (string) $this->input->post('_tour_token');
        if (empty($expected_token) || !hash_equals($expected_token, $submitted_token)) {
            $this->session->set_flashdata('error', 'Security token mismatch. Please reload the page and try again.');
            redirect(base_url('schedule_a_tour'));
            return;
        }
        // Invalidate after first use
        $this->session->unset_userdata('tour_form_token');

        // ── Layer 3: Timing check – reject submissions faster than 3 seconds ────
        $loaded_at = (int) $this->session->userdata('tour_form_loaded');
        if ($loaded_at === 0 || (time() - $loaded_at) < 3) {
            $this->session->set_flashdata('error', 'Form submitted too quickly. Please take a moment to fill in your details.');
            redirect(base_url('schedule_a_tour'));
            return;
        }
        $this->session->unset_userdata('tour_form_loaded');

        // ── Layer 4: IP rate limit (max 5 per hour) ──────────────────────────────
        if (!$this->_tour_ip_rate_ok()) {
            $this->session->set_flashdata('error', 'Too many requests from your network. Please try again later.');
            redirect(base_url('schedule_a_tour'));
            return;
        }

        // ── Layer 5: Email rate limit (max 2 submissions per email per hour) ─────
        $raw_email = $this->input->post('t_mother_email', true);
        if (!empty($raw_email)) {
            $one_hr_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));
            $recent_count = $this->db
                ->where('t_mother_email', $raw_email)
                ->where('t_date >=', $one_hr_ago)
                ->count_all_results('tour');
            if ($recent_count >= 2) {
                $this->session->set_flashdata('error', 'A tour request from this email was recently submitted. Please wait before trying again.');
                redirect(base_url('schedule_a_tour'));
                return;
            }
        }

        $this->load->library('form_validation');
    
        // Required fields (match the new minimal form)
        $this->form_validation->set_rules('t_guardian_first',  'First Name',           'required|trim');
        $this->form_validation->set_rules('t_guardian_last',   'Last Name',            'required|trim');
        $this->form_validation->set_rules('t_mother_phone',    'Phone',                'required|trim');
        $this->form_validation->set_rules('t_mother_email',    'Email',                'required|valid_email');
        $this->form_validation->set_rules('t_start_date_field','Preferred Tour Date',  'required');
        $this->form_validation->set_rules('t_time_slot',       'Preferred Time',       'required');
        $this->form_validation->set_rules('t_program',         'Program Interest',     'required');
        $this->form_validation->set_rules('t_signature_date',  'Expected Start Date',  'required|trim');
        $this->form_validation->set_rules('t_source',          'How did you hear',     'required|trim');
        $this->form_validation->set_rules('t_child_name_1',    'Child First Name',     'required|trim');
        $this->form_validation->set_rules('t_child_lname_1',   'Child Last Name',      'required|trim');
        $this->form_validation->set_rules('t_dob_1',           'Date of Birth',        'required|trim');
        // Optional fields
        $this->form_validation->set_rules('t_other_notes',     'Comment',              'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('post_data', $this->input->post());
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
            return;
        }

        $post_data = $this->input->post();

        // Build full parent name from separate first / last fields
        $post_data['t_mother_name'] = trim(
            ($post_data['t_guardian_first'] ?? '') . ' ' . ($post_data['t_guardian_last'] ?? '')
        );

        // Set defaults for fields not present in the new form
        $post_data += [
            't_gender_1'             => '',
            't_class_1'              => '',
            't_class_2'              => $post_data['t_class_2'] ?? '',
            't_child_name_2'         => '',
            't_child_lname_2'        => '',
            't_gender_2'             => '',
            't_dob_2'                => '',
            't_class_2'              => '',
            't_address'              => '',
            't_city'                 => '',
            't_state'                => '',
            't_zip_code'             => '',
            't_father_name'          => '',
            't_father_phone'         => '',
            't_father_email'         => '',
            't_communication_method' => 'phone',
            't_previous_school'      => '',
            't_important_factors'    => '',
            't_referral_name'        => '',
        ];
    
    
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
        // t_agegroup[] is no longer in the new form; derive from program selection
        $t_agegroups = $this->input->post('t_agegroup', true);
        $post_data['t_agegroups'] = (!empty($t_agegroups) && is_array($t_agegroups))
            ? implode(',', $t_agegroups)
            : (isset($post_data['t_program']) && $post_data['t_program'] !== '' ? $post_data['t_program'] : 'N/A');

        // Normalize contact fields to prevent duplicate bypass via case/whitespace/formatting
        $post_data['t_mother_email'] = strtolower(trim($post_data['t_mother_email'] ?? ''));
        $post_data['t_mother_phone'] = preg_replace('/\D/', '', trim($post_data['t_mother_phone'] ?? ''));

        $this->load->model("schedule_a_tour_model");
        $valid = $this->schedule_a_tour_model->add_tour($post_data);
    
        if ($valid) {
            $tour_id = $this->db->insert_id();
    
            $parent_email = !empty($post_data['t_mother_email'])
                ? $post_data['t_mother_email']
                : (!empty($post_data['t_father_email']) ? $post_data['t_father_email'] : '');
    
            $email_data = array_merge($post_data, [
                't_signature' => !empty($post_data['t_signature']) ? base_url('uploads/signatures/' . $file_name) : 'N/A',
                'timestamp' => time(),
                'tour_id' => $tour_id // Include the tour ID in the email data
            ]);
    
            $email_template1 = $this->load->view('schedule_template', $email_data, true);
            $email_template2 = $this->load->view('thank_template', [
                'name'         => $post_data['t_mother_name'] ?? 'Valued Guest',
                'tour_date'    => $post_data['t_start_date_field'] ?? 'N/A',
                'tour_time'    => $post_data['t_time_slot'] ?? 'N/A',
                'tour_program' => $post_data['t_program'] ?? '',
                'tour_id'      => $tour_id,
            ], true);
    
            // Admin notification: send tour form details + ICS via Gmail SMTP to
            // the configured ADMIN_MAIL_TO address. Uses a dedicated Gmail SMTP
            // channel so it never triggers cPanel self-mail local delivery.
            $mail1 = [
                'sub'  => 'Tour Request Received — Submission Details',
                'body' => $email_template1,
            ];

            // Parent confirmation (thank you note) sent via cPanel SMTP.
            $mail2 = ['adrs' => $parent_email, 'sub' => 'Thank you for scheduling a tour at Harvest Green Montessori', 'body' => $email_template2];

            // Generate ICS and save before sending — attach it to the admin notification (mail1)
            $ics_content  = $this->generate_ics_content($post_data);
            $ics_filepath = null;
            if (!empty($ics_content)) {
                if (!is_dir(FCPATH . 'uploads/ics')) {
                    mkdir(FCPATH . 'uploads/ics', 0777, true);
                }
                $ics_filename = 'tour_event_' . $tour_id . '_' . time() . '.ics';
                $ics_filepath = FCPATH . 'uploads/ics/' . $ics_filename;
                file_put_contents($ics_filepath, $ics_content);
            } else {
                log_message('error', 'Schedule Tour: ICS content empty for tour_id: ' . $tour_id);
            }

            // Send admin notification (tour form details + ICS) via Gmail SMTP
            $mail1_sent = $this->send_admin_mail($mail1, $ics_filepath);

            // Send parent thank-you confirmation via cPanel SMTP
            $mail2_sent = $this->send_applicant_mail($mail2);

            // Get the preferred communication method
            $comm_method = isset($post_data['t_communication_method']) ? strtolower($post_data['t_communication_method']) : 'phone';
            $contact_via = ($comm_method == 'email') ? 'via email' : 'via phone';

            if ($mail1_sent && $mail2_sent) {
                $this->session->set_flashdata('success', 'Tour scheduled successfully! Confirmation emails have been sent.');
            } elseif ($mail1_sent) {
                $this->session->set_flashdata('success', 'Tour scheduled successfully! We have received your request and will contact you ' . $contact_via . '.');
            } elseif ($mail2_sent) {
                $this->session->set_flashdata('success', 'Tour scheduled successfully! A confirmation email has been sent to you.');
            } else {
                $this->session->set_flashdata('success', 'Tour scheduled successfully! We will contact you soon ' . $contact_via . '.');
                log_message('error', 'Schedule Tour: Both admin and parent emails failed to send for tour_id: ' . $tour_id);
            }
            $this->session->set_flashdata('timestamp', time());
    
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            // model already set flashdata('error') for specific failures
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

     // generate_ics_content function
     public function generate_ics_content($data)
     {
         $startDate   = $data['t_start_date_field'] ?? '';
         $timeSlot    = $data['t_time_slot']         ?? '';
         $address     = $data['t_address']            ?? '4100 Harvest Corner Drive, Richmond TX 77406';
         $child1_name = $data['t_child_name_1']       ?? 'Child';
         $child1_prog = $data['t_program']             ?? ($data['t_class_1'] ?? '');

         if (empty($startDate) || strpos($timeSlot, '-') === false) {
             return '';
         }

         // Parse start and end times from the time slot (e.g. "9:00AM-10:00AM")
         $time_parts  = explode('-', $timeSlot);
         $startTime   = date('H:i:s', strtotime(trim($time_parts[0])));
         $endTime     = date('H:i:s', strtotime(trim($time_parts[1])));

         $startDateTime = date("Y-m-d H:i:s", strtotime("$startDate $startTime"));
         $endDateTime   = date("Y-m-d H:i:s", strtotime("$startDate $endTime"));

         $start = gmdate("Ymd\THis\Z", strtotime($startDateTime));
         $end   = gmdate("Ymd\THis\Z", strtotime($endDateTime));

         // Build the ICS file content (RFC 5545 requires CRLF throughout)
         $ics_content  = "BEGIN:VCALENDAR\r\n";
         $ics_content .= "PRODID:-//Harvest Green Montessori//NONSGML v1.0//EN\r\n";
         $ics_content .= "VERSION:2.0\r\n";
         $ics_content .= "BEGIN:VEVENT\r\n";
         $ics_content .= "DTSTART:$start\r\n";
         $ics_content .= "DTEND:$end\r\n";
         $ics_content .= "SUMMARY:Tour Event\r\n";
         $ics_content .= "DESCRIPTION:Tour scheduled for $child1_name (program: $child1_prog)\r\n";
         $ics_content .= "LOCATION:$address\r\n";
         $ics_content .= "END:VEVENT\r\n";
         $ics_content .= "END:VCALENDAR\r\n";

         return $ics_content;
     }



    /**
     * Return already-booked time slots for a given date (AJAX, GET).
     * Used by the frontend to disable taken slots dynamically.
     * Request:  GET /Schedule_a_tour/get_booked_slots?date=04/24/2026
     * Response: JSON array of slot strings, e.g. ["09:30AM-10:00AM","10:00AM-10:30AM"]
     */
    public function get_booked_slots()
    {
        $date = $this->input->get('date');

        if (empty($date)) {
            echo json_encode([]);
            return;
        }

        // Validate date format (mm/dd/yyyy)
        if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
            echo json_encode([]);
            return;
        }

        $this->load->model('schedule_a_tour_model');
        $slots = $this->schedule_a_tour_model->get_booked_slots_for_date($date);
        log_message('debug', '[Schedule_a_tour] get_booked_slots for ' . $date . ': ' . json_encode($slots));
        echo json_encode($slots);
    }

    /**
     * AJAX duplicate-booking check.
     * Request:  GET /Schedule_a_tour/check_duplicate?email=...&phone=...&date=YYYY-MM-DD
     * Response: {"duplicate":false} or {"duplicate":true,"message":"..."}
     */
    public function check_duplicate()
    {
        $this->output->set_content_type('application/json');

        $email = strtolower(trim($this->input->get('email', true) ?? ''));
        $phone = preg_replace('/\D/', '', trim($this->input->get('phone', true) ?? ''));
        $date_iso = trim($this->input->get('date', true) ?? '');

        // Need at least a date and one contact field to check
        if (empty($date_iso) || (empty($email) && empty($phone))) {
            echo json_encode(['duplicate' => false]);
            return;
        }

        // Validate date format YYYY-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_iso)) {
            echo json_encode(['duplicate' => false]);
            return;
        }

        // Convert YYYY-MM-DD → mm/dd/yyyy (stored format in t_start_date_field)
        $parts = explode('-', $date_iso);
        $date_stored = $parts[1] . '/' . $parts[2] . '/' . $parts[0];

        // Check phone match
        if (!empty($phone)) {
            $count = $this->db
                ->where('t_start_date_field', $date_stored)
                ->where('t_mother_phone', $phone)
                ->where('t_status', 1)
                ->count_all_results('tour');
            if ($count > 0) {
                echo json_encode(['duplicate' => true, 'message' => 'You have already booked a tour for this date using this phone number.']);
                return;
            }
        }

        // Check email match (collation is utf8mb4_general_ci → case-insensitive)
        if (!empty($email)) {
            $count = $this->db
                ->where('t_start_date_field', $date_stored)
                ->where('t_mother_email', $email)
                ->where('t_status', 1)
                ->count_all_results('tour');
            if ($count > 0) {
                echo json_encode(['duplicate' => true, 'message' => 'You have already booked a tour for this date using this email address.']);
                return;
            }
        }

        echo json_encode(['duplicate' => false]);
    }

    public function get_school_closed_events()    {
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

    // ── Validation callbacks ──────────────────────────────────────────────────

}
