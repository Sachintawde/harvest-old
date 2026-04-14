<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Career_form extends HOME_Controller {



    public function __construct()

    {    

        ob_start();

        parent::__construct();

        $this->load->library('form_validation');

    }



    public function index(){

        $this->load->view('career-form');

    }

   

    public function add_career() {

        $this->form_validation->set_rules('e_name', 'Your Name', 'required');

        // ... (other validation rules)



        if ($this->form_validation->run() == FALSE) {

            // Validation failed, redirect back to the form with validation errors

            $this->session->set_flashdata('msg', validation_errors());

            $this->session->set_flashdata('class', 'danger');

            redirect($_SERVER["HTTP_REFERER"]);

        } else {

            // Validation passed, proceed with data processing

            $post_data = $this->input->post();



            // Verify reCAPTCHA

            $recaptchaResponse = $post_data['g-recaptcha-response'];

            $secretKey = getenv('RECAPTCHA_SECRET_KEY_CAREER');

            $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}";

            $recaptchaData = json_decode(file_get_contents($recaptchaUrl));

         

            if (!$recaptchaData->success) {

                // reCAPTCHA verification failed

                $this->session->set_flashdata('post_data', $_POST);

                $this->session->set_flashdata('msg', 'Please complete the reCAPTCHA verification.');

                $this->session->set_flashdata('head', 'Error');

                $this->session->set_flashdata('class', 'danger');

                redirect($_SERVER["HTTP_REFERER"]);

                return; // Stop execution

            }



            $this->load->model("career_model");



            // Move the upload library initialization here

            $upload_config = array(

                'upload_path'   => FCPATH . 'assets/uploads/',

                'allowed_types' => 'pdf|doc|docx',

                'max_size'      => 2048,

                'encrypt_name'  => TRUE

            );

            $this->load->library('upload', $upload_config);



            // Check if the upload library was loaded successfully

            if (!$this->upload->do_upload('e_resume')) {

                echo FCPATH . 'uploads/'; // Print the upload path for debugging

                print_r($this->upload->display_errors());

                exit;

            }



            // Continue with the rest of your code

            $file_data = $this->upload->data();

            $post_data['e_resume'] = 'assets/uploads/' . $file_data['file_name']; // Store relative path in the database



            $valid = $this->career_model->add_career($post_data);



            if ($valid) {

                // Send Email

                $email_data = [

                    'name' => $post_data['e_name'],

                    'e_lname' => $post_data['e_lname'],

                    'email' => $post_data['e_mail'], 

                    'phone' => $post_data['e_mob'],

                    'position_to_apply' => $post_data['e_prog'],

                    'address' => $post_data['e_addrs'],

                    'resume' => $post_data['e_resume'],

                    'message' => $post_data['e_msg'],

                    // ... (add more data as needed)

                ];



                // Load the email template content

                $email_template1 = $this->load->view('career_template', $email_data, true);



                $mail = [

                    'adrs' => 'info@harvestgreenmontessori.com', // Replace with the actual recipient email address

                    'sub' => 'Career Application Submission',

                    'body' => $email_template1,

                ];



                $email_sent1 = $this->send_mail($mail);



                $email_data = [

                    'name' => $post_data['e_name'],

                    'position_to_apply' => $post_data['e_prog'],

                    'title'=>'Career Application Submission'

                ];



                // Load the email template content

                $email_template2 = $this->load->view('thank_template', $email_data, true);



                $mail = [

                    'adrs' => $post_data['e_mail'], // Replace with the actual recipient email address

                    'sub' => 'Thank you for appyling position in green harvest montessori',

                    'body' => $email_template2,

                ];



                $email_sent2 = $this->send_mail($mail);



                if ($email_sent1 && $email_sent2) {

                    $this->session->set_flashdata('msg', 'Thank you for contacting us! We will get in touch with you shortly.');

                    $this->session->set_flashdata('class', 'success');

                    redirect($_SERVER["HTTP_REFERER"]);

                } else {

                    $this->session->set_flashdata('msg', 'Error submitting your application. Please try again.');

                    $this->session->set_flashdata('class', 'danger');

                    redirect($_SERVER["HTTP_REFERER"]);

                }

            } else {

                $this->session->set_flashdata('msg', 'Error submitting your application. Please try again.');

                $this->session->set_flashdata('class', 'danger');

                redirect($_SERVER["HTTP_REFERER"]);

            }

        }

    }

}

