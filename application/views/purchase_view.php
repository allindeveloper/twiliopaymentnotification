<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
<head>
<title>MacBook Purchase</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


<script src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/myStyle.css" />

</head>

<body>
	
	
	<div class="container-login100" >
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width:390px;opacity:0.95">
			<form class="login100-form validate-form" action="<?php echo site_url('welcome/pay');?>" method="post">
				<span class="login100-form-title p-b-37">
				<?php echo $item_name;?>
				<center><h6 style="color:green">

				</span>
						<center><h6 class="text-danger"><?php echo $this->session->flashdata('check'); ?>
                        <?php echo $item_description;?></h6></center>
                
                <center>
                <img class="img img-responsive img-thumbnail" src="<?php echo base_url();?>/assets/img/macbook.jfif"/>
                </center>
                <br>
				<center><h6 style="color:black">
                Price
                </h6>
                </center>
                <center><h6 style="color:red">
                ₦ 395,996.4 
                </h6>
                </center>
               
				<div class="container-login100-form-btn">
					<a class="login100-form-btn"name="login" href="<?php echo site_url("Pay/getAuthURL/".$this->code->my_simple_crypt($price, 'e').'/'.$this->code->my_simple_crypt($name, 'e').'/'.$this->code->my_simple_crypt($phone, 'e').'/'.$this->code->my_simple_crypt($email, 'e').'/'.$this->code->my_simple_crypt($item_name, 'e'));?>"target="_blank"  style="width:100px;margin-bottom:5px;"  class="btn_buy"> Buy</a>

				</div><br>
               
				
				
			</form>

			
		</div>
	</div>
	
<!--===============================================================================================-->
<script src="<?php echo base_url();?>assets/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js"></script>

	<script src="<?php echo base_url();?>assets/js/select2.full.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/approve.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/functions.js"></script>
    <script  type="text/javascript" src="<?php echo base_url();?>assets/js/form-validate.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>
</html>