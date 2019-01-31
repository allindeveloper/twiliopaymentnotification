<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
 
class Welcome extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));

        
		$this->load->library('code');
		$this->load->library('paystack', [
            'secret_key'=>'', // your secret key from paystack developers console https://dashboard.paystack.com/#/settings/developer
            'public_key'=>'' //  your public key from paystack developers console https://dashboard.paystack.com/#/settings/developer
            ]);

		
    
		error_reporting(0);
    }
    public function index()
    {
		$data['email']=''; // your email goes here
		$data['price']= 0; // your price goes here
		$data['item_name']=''; // the item name goes here
		$data['item_description'] = "";// the item description goes here
		$data['name'] = ""; // your name goes here
		$data['phone'] = ""; // your phone number goes here e.g  +2347034367931
		$this->load->view('purchase_view', $data); // send the data to the purchase view page
    }
 

}