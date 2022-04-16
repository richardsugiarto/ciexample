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
<h1>Checkout Page</h1>
<?php
if($this->session->flashdata('errorstok'))
{
  echo "<font style='color:red'>".$this->session->flashdata('errorstok')."</font>";
}
echo form_open('cont/index');
echo "<center><table border=1>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Qty</th>";
echo "<th>Price</th>";
echo "<th>Name</th>";
echo "<th>Cancel</th>";
echo "<th>Ubah Qty</th>";
echo "</tr>";
foreach ($this->cart->contents() as $key) {
  echo "<tr>";
  echo "<td>".$key['id']."</td>";
  echo "<td>".$key['qty']."</td>";
  echo "<td>".$key['price']."</td>";
  echo "<td>".$key['name']."</td>";
  echo "<td>".form_submit('btnCancelCart['.$key['rowid'].']','Cancel')."</td>";
  echo "<td>".form_input($key['rowid'])." ".form_submit('btnUbahQty['.$key['rowid'].']','Ubah')."</td>";
  echo "</tr>";
}
echo "</table></center>";
echo $this->cart->total();
echo "<center>".form_submit('btnCheckOutAll','Check Out All items')."</center>";
echo form_close();
?>
</body>
</html>
