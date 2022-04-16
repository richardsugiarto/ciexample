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
<h1>Shopping Page</h1>
<?php
echo form_open('cont/index');
if($this->session->flashdata('errorbuy'))
{
  echo "<font style='color:red'>".$this->session->flashdata('errorbuy')."</font>";
}
if($this->session->flashdata('successbuy'))
{
  echo "<font style='color:green'>".$this->session->flashdata('successbuy')."</font>";
}
echo "<center>";
echo "<table border=1>";
echo "<tr>";
echo "<th>Gambar</th>";
echo "<th>Nama Barang</th>";
echo "<th>Penjual</th>";
echo "<th>Kota Penjual</th>";
echo "<th>Lihat Barang</th>";
echo "</tr>";
foreach ($shop as $key) {
  if($key->iduser!=$user[0]->iduser)
  {
    foreach ($all_user as $val) {
      if($val->iduser==$key->iduser)
      {
        echo "<tr>";
        echo "<td><img src='".base_url('uploads/'.$key->gambar)."' width=200 height=100></td>";
        if($key->qty!=0)
        {
          echo "<td>".$key->nama."</td>";
        }
        else {
          echo "<td>".$key->nama."<br><font style='color:red'>SOLD OUT</font></td>";
        }
        echo "<td>".$val->namad."</td>";
        echo "<td>".$key->kota."</td>";
        echo "<td>".form_submit('btnLihatBrg['.$key->id_shop.']','Lihat Barang')."</td>";
        echo "</tr>";
      }
    }
  }
}
echo "</table></center>";
echo "<center>".form_submit('btnCheckOut','Check Out')."</center>";
echo form_close();
?>
</body>
</html>
