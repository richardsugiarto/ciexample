<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
<script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>
<?php

	echo "<div class='wrapper'>";
	$attrform_open=array('class'=>'form-signin');
	echo form_open('cont/index',$attrform_open);
	echo "<h2 class='form-signin-heading'>Login To Your Account</h2>";
	$attrform_username=array('name'=>'username','class'=>'form-control','placeholder'=>'Email Address','autofocus'=>'');
	echo form_input($attrform_username);
	if($this->session->flashdata('username_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('username_error')."</font>";
  }
	echo "<br>";
	$attrform_password=array('name'=>'password','class'=>'form-control','placeholder'=>'Password');
	echo form_input($attrform_password);
	if($this->session->flashdata('password_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('password_error')."</font>";
  }
	echo "<br>";
	echo form_submit('btnLogin','Login',array('class'=>'btn btn-lg btn-primary btn-block'));
	echo form_submit('btnRegister','Register',array('class'=>'btn btn-lg btn-primary btn-block'));
	if($this->session->flashdata('logout')!=null)
	{
		echo "<h2>".$this->session->flashdata('logout')."</h2>";
	}
	echo form_close();
	echo "</div>";
?>
