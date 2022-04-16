<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
<script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>
<h2 style='text-align:right'><?php echo $user[0]->namad." ".$user[0]->namab;?></h2>
<div class="container">
    <h1 class="well">Edit Account</h1>
	<div class="col-lg-12 well">
<?php
	echo form_open();
	echo "<div class='row'>";
		echo "<div class='col-sm-6 form-group'>";
		echo "Nama Depan : ".form_input(array('name'=>'namad','placeholder'=>"First Name", 'class'=>"form-control"))."<br>";
		if(isset($namad_error)){
		  echo "<font style='color:red'>".$namad_error."</font>";
		}
		echo "</div>";
		echo "<div class='col-sm-6 form-group'>";
		echo "Nama Belakang : ".form_input(array('name'=>'namab','placeholder'=>"Last Name", 'class'=>"form-control"))."<br>";
		if(isset($namab_error)){
		  echo "<font style='color:red'>".$namab_error."</font>";
		}
		echo "</div>";
	echo "</div>";
	echo "E-mail : ".form_input(array('name'=>'email','placeholder'=>"Email", 'class'=>"form-control"))."<br>";
	if(isset($email_error)){
      echo "<font style='color:red'>".$email_error."</font>";
  }
	echo "No HP : ".form_input(array('name'=>'hp','placeholder'=>"Phone Number", 'class'=>"form-control"))."<br>";
	if(isset($hp_error)){
      echo "<font style='color:red'>".$hp_error."</font>";
  }
	echo "Password : ".form_input(array('name'=>'pass','placeholder'=>"Password", 'class'=>"form-control"))."<br>";
	if(isset($pass_error)){
      echo "<font style='color:red'>".$pass_error."</font>";
  }
	echo "Confirm password : ".form_input(array('name'=>'confirmpass','placeholder'=>"Confirm Password", 'class'=>"form-control"))."<br>";
	if(isset($confirmpass_error)){
      echo "<font style='color:red'>".$confirmpass_error."</font>";
  }


	echo form_submit('btnEditedaccount','Edit',array('class'=>'btn btn-lg btn-info'));
	echo form_submit('btnBackAccount','Back',array('class'=>'btn btn-lg btn-info'));

	echo form_close();
?>
</div></div>
