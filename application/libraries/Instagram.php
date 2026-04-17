<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH.'libraries/src/Facebook/autoload.php'; // Path to the Facebook SDK autoload file
require_once APPPATH.'libraries/src/Facebook/autoload.php'; // Path to the Facebook SDK autoload file

class Instagram {
    private $ci;
    private $fb;

    public function __construct() {
        $this->ci =& get_instance();
        $this->ci->config->load('instagram'); // Load Instagram API configuration file

        $this->fb = new Facebook\Facebook([
            'app_id' => $this->ci->config->item('app_id'),
            'app_secret' => $this->ci->config->item('app_secret'),
            'default_graph_version' => 'v12.0' // Use the appropriate API version
        ]);
    }

    public function getPosts($user_id, $limit = 10) {
        try {
            $response = $this->fb->get("/$user_id/media", $this->ci->config->item('access_token'));
            $data = $response->getGraphEdge()->asArray();
            return array_slice($data, 0, $limit);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API errors
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK errors
        }

        return array();
    }
}
