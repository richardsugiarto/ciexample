<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
<script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>
<div class="container">
    <h1 class="well">Registration</h1>
	<div class="col-lg-12 well">
<?php

	echo form_open();
	echo "<div class='row'>";
		echo "<div class='col-sm-6 form-group'>";
		echo "Nama Depan : ".form_input(array('name'=>'namad','placeholder'=>"First Name", 'class'=>"form-control"))."<br>";
		if($this->session->flashdata('namad_error')!=null){
		  echo "<font style='color:red'>".$this->session->flashdata('namad_error')."</font>";
		}	
		echo "</div>";
		echo "<div class='col-sm-6 form-group'>";
		echo "Nama Belakang : ".form_input(array('name'=>'namab','placeholder'=>"Last Name", 'class'=>"form-control"))."<br>";
		if($this->session->flashdata('namab_error')!=null){
		  echo "<font style='color:red'>".$this->session->flashdata('namab_error')."</font>";
		}
		echo "</div>";
	echo "</div>";
	echo "E-mail : ".form_input(array('name'=>'email','placeholder'=>"Email", 'class'=>"form-control"))."<br>";
	if($this->session->flashdata('email_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('email_error')."</font>";
  }
	echo "No HP : ".form_input(array('name'=>'hp','placeholder'=>"Phone Number", 'class'=>"form-control"))."<br>";
	if($this->session->flashdata('hp_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('hp_error')."</font>";
  }
	echo "Password : ".form_input(array('name'=>'pass','placeholder'=>"Password", 'class'=>"form-control"))."<br>";
	if($this->session->flashdata('pass_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('pass_error')."</font>";
  }
	echo "Confirm password : ".form_input(array('name'=>'confirmpass','placeholder'=>"Confirm Password", 'class'=>"form-control"))."<br>";
	if($this->session->flashdata('confirmpass_error')!=null){
      echo "<font style='color:red'>".$this->session->flashdata('confirmpass_error')."</font>";
  }

	echo form_submit('btnNext','Next',array('class'=>'btn btn-lg btn-info'));

	echo form_close();
?>
</div>
</div>
