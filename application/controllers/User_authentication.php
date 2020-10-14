<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller {

    function __construct() {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');

        //Load user model
        // $this->load->model('user');
    }

    public function index() {
        $userData = array();

        // Check if user is logged in
        if ($this->facebook->is_authenticated()) {
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
            $userData['fb_id'] = $userProfile['id'];
            $userData['name'] = $userProfile['first_name'] . " " . $userProfile['last_name'];
            if($userProfile['email'] && filter_var($userProfile['email'], FILTER_VALIDATE_EMAIL)){
                $userData['email'] = $userProfile['email'];
            }
            else{
                $userData['email'] = $userProfile['id'] . "@gmail.com";
            }
            $userData['password'] = md5(rand(1000, 9999));
            
            $dt = $this->om->view("id, email", "admins", array("fb_id"=>$userData['fb_id']));
            if(!$dt){
                $dt = $this->om->view("id, email", "admins", array("email"=>$userData['email']));
                if(!$dt){
                    $this->om->InsertData("admins", $userData);
                }
                else{
                    $this->om->UpdateData("admins", array('fb_id'=>$userData['fb_id']), array('email'=>$userData['email']));
                }
            }
            $dt = $this->om->view("*", "admins", array("fb_id"=>$userData['fb_id']));
            foreach ($dt as $d) {
                $sdata = [
						'id' => $d->id,
                    	'name' => $d->name,
                    	'type' => $d->user_type,
                    	'email' => $d->email,
                    	'picture' => $d->picture,
                    	'designation' => $d->designation,
                    	'mobile' => $d->mobile,
                    ];
              $this->session->set_userdata($sdata);
                redirect(base_url("dashboard"), "refresh");
            }
        } 
        redirect(base_url(), "refresh");
    }

    public function logout() {
		$this->session->unset_userdata("id");
		$this->session->unset_userdata("name");
		$this->session->unset_userdata("type");
		$this->session->unset_userdata("email");
		$this->session->unset_userdata("picture");
		$this->session->unset_userdata("designation");
		$this->session->unset_userdata("mobile");
        
        // Remove local Facebook session
        $this->facebook->destroy_session();

        redirect(base_url(), "refresh");
    }

}
