<?php
defined('BASEPATH') OR exit("Access Denied");
use Twilio\Rest\Client;
/**
 * Description of Pay Controller
 *
 * @author Uchendu Precious <uchendubozz@gmail.com>
 * @date 31-Jan-2019
 */
class Pay extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation'));

        $this->load->library('code');
        $this->load->library('paystack', [
            'secret_key'=>'sk_test_3ce1fc2d77e8c393576ca9ad20fcf285ee800d28', 
            'public_key'=>'pk_test_69194674d6b3d94fcb216914c9027e926d3f53ae']);
    }

    function randstr($j = 12){
        $string = "";
        for($i=0; $i < $j; $i++){
            $x = mt_rand(0, 2);
            switch($x){
                case 0: $string.= chr(mt_rand(97,122));break;
                case 1: $string.= chr(mt_rand(65,90));break;
                case 2: $string.= chr(mt_rand(48,57));break;
            }
        }
        return $string; 
    }
   
    /**
     * Initialise a transaction by getting only the authorised URL returned
     */
    public function getAuthURL(){
        $this->session->set_userdata('name',$this->code->my_simple_crypt($this->uri->segment(4), 'd'));
        $this->session->set_userdata('price',$this->code->my_simple_crypt($this->uri->segment(3), 'd') * 100);
        
        $this->session->set_userdata('email',$this->code->my_simple_crypt($this->uri->segment(6), 'd'));
        $this->session->set_userdata('item_name',$this->code->my_simple_crypt($this->uri->segment(7), 'd'));
        $this->session->set_userdata('phone',$this->code->my_simple_crypt($this->uri->segment(5), 'd'));

       $price = $this->code->my_simple_crypt($this->uri->segment(3), 'd') * 100;
       $name = $this->code->my_simple_crypt($this->uri->segment(4), 'd');
       $phone = $this->code->my_simple_crypt($this->uri->segment(5), 'd');
       $email = $this->code->my_simple_crypt($this->uri->segment(6), 'd');
       $url = $this->paystack->init($this->randstr(12) ,$price,$email, [
           'name'=>$name,
           'ID'=>str_shuffle($name).$this->randstr(2),
           "Phone"=>$phone
       ], base_url('Pay/callback'), FALSE);
        
        //$url ? header("Location: {$url}") : "";
        $url ? redirect($url) : "";
    }


    
    public function verify($ref){
        //verifyTransaction($ref) will return an array of verification details or FALSE on failure
        $ver_info = $this->paystack->verifyTransaction($ref);
        
        //do something if verification is successful e.g. save authorisation code
        if($ver_info && ($ver_info->status = TRUE) && ($ver_info->data->status == "success")){
            $auth_code = $ver_info->data->authorization->authorization_code;
            $day = date("jS ");
            $month =  date("F");
            $year = date("Y");
            $time = date(' h:i:a');
            //do something with $auth_code. $auth_code can be used to charge the customer next time
            // echo $auth_code;
            $data['authcode'] = $auth_code;
            $data['ref'] = $ref;
            $data['status'] = $ver_info->status;
            $data['date'] = $day.''.$month.''.$year;
            $data['time'] = $time;
            $data['price'] = $this->session->userdata('price');
            $data['email'] = $this->session->userdata('email');
            $data['item_name'] = $this->session->userdata('item_name');
            $message = 'You just Purchased '.$this->session->userdata('item_name'). ' at '.number_format($this->session->userdata('price'),3). ' on '.$day.''.$month.''.$year;
         $data = ['phone' => '+2347034367931', 'text' => $message];
		$this->sendSMS($data);
           
        }
        
        else{
            $this->load->view('errors/magazine_error' ); 
        }
    }
    protected function sendSMS($data) {
        // Your Account SID and Auth Token from https://www.twilio.com/console
          $sid = ''; // your sid token goes here
          $token = ''; // your auth token goes there
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
            $this->load->view('success_view', $data);
          }else{
              echo 'Message Not Sent';
          }
  }
    
    public function callback(){
        $trxref = $this->input->get('trxref', TRUE);
        $ref = $this->input->get('reference', TRUE);
        
        //do something e.g. verify the transaction
        if($trxref === $ref){
            $this->verify($trxref);
        }
    }

}