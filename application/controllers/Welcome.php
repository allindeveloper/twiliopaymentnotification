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
		$data['email']='uchendubozz@gmail.com';
		$data['price']= 395996.4;
		$data['item_name']='MacBook Air';
		$data['item_description'] = "Apple MacBook Air (13-inch Retina display, 1.6GHz dual-core Intel Core i5, 128GB) - Silver (Latest Model)";
		$data['name'] = "Uchendu Precious";
		$data['phone'] = "+2347034367931";
		$this->load->view('purchase_view', $data);
    }
 

}