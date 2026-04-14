<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Contact extends HOME_Controller {



    public function __construct()

    {    
        ob_start();
        parent::__construct();
    }



    public function index(){

        $this->load->view("contact");

    }

    public function send(){

        // Only accept AJAX / XHR requests
        if (!$this->input->is_ajax_request()) {
            redirect('contact');
            return;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('c_first_name', 'First Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('c_last_name',  'Last Name',  'required|trim|max_length[100]');
        $this->form_validation->set_rules('c_email',      'Email',      'required|trim|valid_email|max_length[200]');
        $this->form_validation->set_rules('c_phone',      'Phone',      'trim|max_length[30]');
        $this->form_validation->set_rules('c_program',    'Program',    'trim|max_length[100]');
        $this->form_validation->set_rules('c_message',    'Message',    'trim|max_length[2000]');

        header('Content-Type: application/json');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode([
                'status'  => 'error',
                'message' => strip_tags(validation_errors()),
            ]);
            return;
        }

        $first_name = $this->input->post('c_first_name', TRUE);
        $last_name  = $this->input->post('c_last_name',  TRUE);
        $email      = $this->input->post('c_email',      TRUE);
        $phone      = $this->input->post('c_phone',      TRUE);
        $program    = $this->input->post('c_program',    TRUE);
        $message    = $this->input->post('c_message',    TRUE);

        // Save to the contact table so it appears in the admin panel
        $this->load->model('Contact_model');
        $contact_data = array(
            'con_name'  => $first_name,
            'con_lname' => $last_name,
            'con_mail'  => $email,
            'con_mob'   => $phone,
            'con_kid'   => $program,
            'con_msg'   => $message,
        );
        $saved = $this->Contact_model->add_contact($contact_data);

        if ($saved) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Thank you, ' . htmlspecialchars($first_name) . '! Your message has been sent. We will get back to you shortly.',
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Sorry, we could not send your message. Please try again or call us at 281-819-PLAY (7529).',
            ]);
        }
    }

}

?>

