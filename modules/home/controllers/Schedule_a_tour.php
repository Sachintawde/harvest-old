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
        $html .= '<h2>SMTP Diagnostic &mdash; Harvest Green Montessori</h2>';
        $html .= '<p>Environment: <strong>' . ENVIRONMENT . '</strong> &nbsp;|&nbsp; PHP: ' . phpversion()
               . ' &nbsp;|&nbsp; ' . date('Y-m-d H:i:s') . ' (server time)</p>';

        $cacert = APPPATH . 'config/cacert.pem';
        $html .= '<table><tr><th colspan="2">Server</th></tr>'
               . '<tr><td>OpenSSL</td><td>' . (defined('OPENSSL_VERSION_TEXT') ? OPENSSL_VERSION_TEXT : '<span class="fail">NOT LOADED</span>') . '</td></tr>'
               . '<tr><td>cacert.pem</td><td>' . (is_file($cacert) ? '<span class="ok">Found (' . number_format(filesize($cacert)) . ' bytes)</span>' : '<span class="fail">MISSING</span>') . '</td></tr>'
               . '<tr><td>Email class</td><td>' . get_class($this->email) . '</td></tr>'
               . '</table>';

        // Helper: TCP port check
        $port_status = function ($host, $port) {
            $fp = @fsockopen($host, $port, $errno, $errstr, 6);
            if ($fp) { fclose($fp); return '<span class="ok">OPEN</span>'; }
            return '<span class="fail">BLOCKED &mdash; ' . htmlspecialchars($errstr) . ' (' . $errno . ')</span>';
        };

        // Helper: attempt actual SMTP send
        $do_send = function ($label, $cfg, $from_addr, $to_addr) use (&$html) {
            $this->email->clear(TRUE);
            $this->email->initialize($cfg);
            $this->email->from($from_addr, 'HGM Diagnostic');
            $this->email->to($to_addr);
            $this->email->subject('[TEST] ' . $label . ' &mdash; ' . date('Y-m-d H:i:s'));
            $this->email->message('<p>Diagnostic test via <strong>' . htmlspecialchars($label)
                . '</strong> at ' . date('Y-m-d H:i:s') . '</p>');
            if ($this->email->send()) {
                $html .= '<p class="ok">&#10004; SENT &rarr; ' . htmlspecialchars($to_addr) . '</p>';
                log_message('info', '[test_mail] ' . $label . ' OK -> ' . $to_addr);
            } else {
                $dbg = $this->email->print_debugger();
                $html .= '<p class="fail">&#10008; FAILED &rarr; ' . htmlspecialchars($to_addr) . '</p>'
                       . '<pre>' . htmlspecialchars($dbg) . '</pre>';
                log_message('error', '[test_mail] ' . $label . ' FAILED -> ' . $to_addr . ': '
                    . $this->email->print_debugger(['headers', 'subject']));
            }
        };

        // ── 1. Admin SMTP ─────────────────────────────────────────────────────
        $html .= '<div class="box"><h3>&#9312; Admin SMTP (tour details + ICS &rarr; admin inbox)</h3>';
        $a_cfg  = $this->_smtp_config_admin();
        $a_from = env('ADMIN_MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        $a_to   = env('ADMIN_MAIL_TO', 'info@harvestgreenmontessori.com');
        $html .= '<table>'
               . '<tr><td>Host</td><td>' . htmlspecialchars($a_cfg['smtp_host']) . '</td></tr>'
               . '<tr><td>Port ' . $a_cfg['smtp_port'] . '</td><td>' . $port_status($a_cfg['smtp_host'], $a_cfg['smtp_port']) . '</td></tr>'
               . '<tr><td>Crypto</td><td>' . htmlspecialchars($a_cfg['smtp_crypto']) . '</td></tr>'
               . '<tr><td>Auth user</td><td>' . htmlspecialchars($a_cfg['smtp_user']) . '</td></tr>'
               . '<tr><td>From</td><td>' . htmlspecialchars($a_from) . '</td></tr>'
               . '<tr><td>To (ADMIN_MAIL_TO)</td><td>' . htmlspecialchars($a_to) . '</td></tr>'
               . '</table>';
        $do_send('Admin SMTP', $a_cfg, $a_from, $a_to);
        $html .= '</div>';

        // ── 2. Applicant SMTP ─────────────────────────────────────────────────
        $html .= '<div class="box"><h3>&#9313; Applicant SMTP (thank-you &rarr; parent)</h3>';
        $p_cfg  = $this->_smtp_config_applicant();
        $p_from = env('APPLICANT_MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        // Send test to admin Gmail to avoid self-mail during diagnostics
        $p_to   = env('ADMIN_MAIL_TO', $p_cfg['smtp_user']);
        $html .= '<table>'
               . '<tr><td>Host</td><td>' . htmlspecialchars($p_cfg['smtp_host']) . '</td></tr>'
               . '<tr><td>Port ' . $p_cfg['smtp_port'] . '</td><td>' . $port_status($p_cfg['smtp_host'], $p_cfg['smtp_port']) . '</td></tr>'
               . '<tr><td>Crypto</td><td>' . htmlspecialchars($p_cfg['smtp_crypto']) . '</td></tr>'
               . '<tr><td>Auth user</td><td>' . htmlspecialchars($p_cfg['smtp_user']) . '</td></tr>'
               . '<tr><td>From</td><td>' . htmlspecialchars($p_from) . '</td></tr>'
               . '<tr><td>Test sending TO</td><td>' . htmlspecialchars($p_to) . '</td></tr>'
               . '</table>';
        $do_send('Applicant SMTP', $p_cfg, $p_from, $p_to);
        $html .= '</div>';

        $html .= '<p style="color:#8b949e;font-size:11px">&#9888; Remove or protect this endpoint before leaving in production.</p>';
        $this->output->set_header('Cache-Control: no-store, no-cache');
        $this->output->set_content_type('text/html', 'utf-8');
        echo $html;
    }

    public function add_tour()
    {
        $this->load->library('form_validation');
    
        // Required fields (match the new minimal form)
        $this->form_validation->set_rules('t_guardian_first',  'First Name',           'required|trim');
        $this->form_validation->set_rules('t_guardian_last',   'Last Name',            'required|trim');
        $this->form_validation->set_rules('t_mother_phone',    'Phone',                'required|trim');
        $this->form_validation->set_rules('t_mother_email',    'Email',                'required|valid_email');
        $this->form_validation->set_rules('t_start_date_field','Preferred Tour Date',  'required');
        $this->form_validation->set_rules('t_time_slot',       'Preferred Time',       'required');
        $this->form_validation->set_rules('t_program',         'Program Interest',     'required');
        $this->form_validation->set_rules('t_signature_date',  'Expected Start Date',  'required');
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
    
        // Verify reCAPTCHA
        $recaptchaResponse = isset($post_data['g-recaptcha-response']) ? trim($post_data['g-recaptcha-response']) : '';
        $secretKey         = '6LdfSIcsAAAAAAbz0dnD2aflssbcNuNzr2PK1XEB';

        if (empty($recaptchaResponse)) {
            $this->session->set_flashdata('post_data', $_POST);
            $this->session->set_flashdata('msg', 'Please complete the reCAPTCHA verification.');
            $this->session->set_flashdata('head', 'Error');
            $this->session->set_flashdata('class', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['secret' => $secretKey, 'response' => $recaptchaResponse]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $recaptchaResult = curl_exec($ch);
        $curlError       = curl_error($ch);
        curl_close($ch);

        if ($recaptchaResult === false) {
            log_message('error', 'reCAPTCHA cURL error: ' . $curlError);
            // Fail open only if cURL itself failed (network issue on server side)
            // Comment this block out to enforce reCAPTCHA strictly
        } else {
            $recaptchaData = json_decode($recaptchaResult);
            if (empty($recaptchaData->success)) {
                $this->session->set_flashdata('post_data', $_POST);
                $this->session->set_flashdata('msg', 'reCAPTCHA verification failed. Please try again.');
                $this->session->set_flashdata('head', 'Error');
                $this->session->set_flashdata('class', 'danger');
                redirect($_SERVER['HTTP_REFERER']);
                return;
            }
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
        // t_agegroup[] is no longer in the new form; derive from program selection
        $t_agegroups = $this->input->post('t_agegroup', true);
        $post_data['t_agegroups'] = (!empty($t_agegroups) && is_array($t_agegroups))
            ? implode(',', $t_agegroups)
            : (isset($post_data['t_program']) && $post_data['t_program'] !== '' ? $post_data['t_program'] : 'N/A');
    
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
