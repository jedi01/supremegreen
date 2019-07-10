<?php

class Logout extends CI_Controller {


	function __construct() {
        parent::__construct();
        
    }

    public function logout(){

    	$redirect_url = base_url("admin");        	
        $this->session->unset_userdata("user_session");
		redirect($redirect_url);


     }       
 
 }   