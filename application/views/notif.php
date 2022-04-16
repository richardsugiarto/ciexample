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
<h4>
<?php

echo "<h2 style='text-align:right'>".$user[0]->namad." ".$user[0]->namab."</h2> ";
echo form_open('cont/index');
echo "<div class='col-sm-10'></div>".form_submit('btnLogout','Log out',array('class'=>'btn btn-default'));
  echo "<div class='col-sm-3'></div>
  <div class='col-sm-6'>
  <ul class='list-group'>
  <li class='list-group-item' style='background-color:gray'><h4>Notification</h4></li>";
  foreach ($notif as $key) {

    if($key->isinotif=="permintaan pertemanan")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>".$key->isinotif." dari ".$val->namad." ".$val->namab."<br>";
          echo form_submit($key->idfriend,'accept').form_submit($key->idfriend,'reject')."</li>";

        }
      }
    }
    if($key->isinotif=="Permintaan pertemanan disetujui")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Permintaan pertemanan disetujui oleh ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="Permintaan pertemanan ditolak")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Permintaan pertemanan ditolak oleh ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="Komentar")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Posting anda dikomentari oleh ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="Like")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Posting anda dilike oleh ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="Read")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Terdapat chat yang belum terbaca dari ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="lihatprofile")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Profile anda dilihat oleh ".$val->namad." ".$val->namab."</li>";
        }
      }
    }
    if($key->isinotif=="Mention")
    {
      foreach ($other as $val) {
        if($key->iduser2==$val->iduser)
        {
          echo "<li class='list-group-item'>Anda dimention oleh  ".$val->namad." ".$val->namab.form_submit('btnLihat['.$key->iduser2.']','Lihat',array('class'=>'btn btn-default'))."</li>";
        }
      }
    }
  }
  echo "</h4>";
  echo "</ul>";
	echo form_close();
  echo "<br>";
?>
<?=$links;
echo "</div>
<div class='col-sm-3'></div>";
?>
</body>
</html>
