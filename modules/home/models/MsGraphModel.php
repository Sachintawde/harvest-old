<?php
class MsGraphModel extends CI_Model
{

    private $access_token;

    public function __construct()
    {
        parent::__construct();
        $this->load->config('ms_graph');
        $this->access_token = $this->getAccessToken();
    }

    // Get Access Token using cURL
    // Get Access Token using cURL
    private function getAccessToken()
    {
        $url = $this->config->item('auth_url');

        $data = array(
            'client_id' => $this->config->item('client_id'),
            'client_secret' => $this->config->item('client_secret'),
            'scope' => 'https://graph.microsoft.com/.default', // Correct scope for Microsoft Graph API
            'grant_type' => 'client_credentials'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

        $responseData = json_decode($response, true);

        // Log or print the full response for debugging
        if (isset($responseData['error'])) {
            echo 'Error retrieving access token: ' . json_encode($responseData);
            return null;
        }

        if (isset($responseData['access_token'])) {
            return $responseData['access_token'];
        }

        echo 'Access token not found in response: ' . json_encode($responseData);
        return null;
    }


    // Create a calendar event
    public function createEvent($email, $subject, $startTime, $endTime, $description)
    {
        $url = $this->config->item('graph_api_url') . "/users/$email/calendar/events";

        $eventData = json_encode(array(
            'subject' => $subject,
            'start' => array('dateTime' => $startTime, 'timeZone' => 'UTC'),
            'end' => array('dateTime' => $endTime, 'timeZone' => 'UTC'),
            'body' => array('content' => $description, 'contentType' => 'text')
        ));
        
        $headers = array(
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $eventData);

        $response = curl_exec($curl);
        curl_close($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
            return null;
        }

        $responseData = json_decode($response, true);

        if (isset($responseData['error'])) {
            echo 'Error creating event: ,,' . json_encode($responseData);
            return null;
        }

        return $responseData;
    }
}
