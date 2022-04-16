<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
  <script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>

</head>
<body>

<ul class="nav nav-tabs">
  <li><a href="<?php echo site_url('cont/profile')."?activeuser=".$user[0]->email;?>">Profile</a></li>
  <li><a href="<?php echo site_url('cont/explore')."?activeuser=".$user[0]->email;?>">Explore</a></li>
  <li><a href="<?php echo site_url('cont/newsfeed')."?activeuser=".$user[0]->email;?>">NewsFeed</a></li>
  <li><a href="<?php echo site_url('cont/notif')."?activeuser=".$user[0]->email;?>">Notification</a></li>
  <li><a href="<?php echo site_url('cont/chat')."?activeuser=".$user[0]->email;?>">Chat</a></li>
  <li><a href="<?php echo site_url('cont/shop')."?activeuser=".$user[0]->email;?>">Shop</a></li>
</ul>
<?php
echo "<h2 style='text-align:right'>".$user[0]->namad." ".$user[0]->namab."</h2>";
echo form_open('cont/index');
echo "<div class='col-sm-10'></div>".form_submit('btnLogout','Log out',array('class'=>'btn btn-default'));
echo "<div class='row'><div class='col-sm-3'></div><div class='col-sm-7'><div class='panel panel-default'>
  <div class='panel-heading'><h2>List Skill</h2></div>";
  if(isset($error))
  {
    echo "<h3>".$error."</h3>";
  }
  $jmlendorse=0;
  if(isset($skill))
  {
    foreach ($skill as $key) {
      echo "<div class='panel'><center>";
      $jmlendorse=0;
      echo "Skill : ".form_submit('btnDeleteSkill['.$key->id_skill.']','X',array('class'=>'btn btn-default'))."<br>".$key->nama_skill."<br>";
      foreach ($endorse as $val) {
        if($key->id_skill==$val->id_skill)
        {
            $jmlendorse+=1;
        }
      }
      echo "<button name=\"ajaxendorsed\" id='".$key->id_skill."' class='btn btn-default'>Jumlah endorsement : ".$jmlendorse."</button><br>";
      echo "<div id='ajax_success'></div>";
      echo "</center></div>";
    }
  }
  echo "<br>";
  $arr=array();
  if(isset($jenis))
  {
    foreach ($jenis as $key) {
      $arr[$key->id_jnsskill]=$key->nama_skill;
    }
  }
  echo "<center>Insert new skill<br>";
  echo form_dropdown('combojenis',$arr);
  echo form_input(array('name'=>'txtskill'));
  echo form_submit('btnInsertSkill','Insert',array('class'=>'btn btn-default'))."<br><br>";
	echo form_close();
  echo "</center></div></div></div>";
?>
<script src="<?php echo base_url();?>jquery.js"></script>
<script>
$(document).ready(function(){

    $("button[name='ajaxendorsed']").click(function()
    {
     $.ajax({
         type: "POST",
         url: "<?php echo site_url('cont/ajaxendorse') ?>",
         data: {id: $(this).attr('id')},
         dataType: "text",
         cache:false,
         success:
              function(data){
                $('#ajax_success').replaceWith(data);
                //alert(data);  //as a debugging message.
              }
          });// you have missed this bracket
     return false;
 });
 });
</script>
</body>



</html>
