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
        // $data = ['phone' => '+2347034367931', 'text' => 'Sending SMS wit Twill for PayStack Integration Just Worked'];
		// print_r($this->sendSMS($data));
		

    }
 
    protected function sendSMS($data) {
          // Your Account SID and Auth Token from twilio.com/console
            $sid = 'AC37a5a07f2c41d65e5f4e600d6d189aa9';
            $token = '0c803cf87f8961d682710870a323c090';
            $client = new Client($sid, $token);
            
            // Use the client to do fun stuff like send text messages!
            $sent =   $client->messages->create(
                // the number you'd like to send the message to
                $data['phone'],
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    "from" => "+19897182290",
                    // the body of the text message you'd like to send
                    'body' => $data['text']
                )
			);
			if($sent){
				return 'Message Sent';
			}else{
				return 'Message Not Sent';
			}
    }
}