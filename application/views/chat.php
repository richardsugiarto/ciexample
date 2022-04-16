<!DOCTYPE html>
<html>
<head>

</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
<style>
img.zoom {
    width: 70px;
    height: 70px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}
.transisi {
    -webkit-transform: scale(1.8);
    -moz-transform: scale(1.8);
    -o-transform: scale(1.8);
    transform: scale(1.8);
}
</style>
<body>
<ul class="nav nav-tabs">
  <li><a href="<?php echo site_url('cont/profile')."?activeuser=".$user[0]->email;?>">Profile</a></li>
  <li><a href="<?php echo site_url('cont/explore')."?activeuser=".$user[0]->email;?>">Explore</a></li>
  <li><a href="<?php echo site_url('cont/newsfeed')."?activeuser=".$user[0]->email;?>">NewsFeed</a></li>
  <li><a href="<?php echo site_url('cont/notif')."?activeuser=".$user[0]->email;?>">Notification</a></li>
  <li><a href="<?php echo site_url('cont/chat')."?activeuser=".$user[0]->email;?>">Chat</a></li>
  <li><a href="<?php echo site_url('cont/shop')."?activeuser=".$user[0]->email;?>">Shop</a></li>
</ul>

<script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>


<?php
echo "<h2 style='text-align:right'>".$user[0]->namad." ".$user[0]->namab."</h2>";
echo form_open('cont/index');
echo "<div class='container'>
    <div class='row'>
        <div class='col-xs-12 col-sm-offset-3 col-sm-6'>
            <div class='panel panel-default'>
                <div class='panel-heading c-list'>
                    <span class='title'>List Chat</span>
                </div>";
                echo "<div class='row' style='display: none;'>
                    <div class='col-xs-12'>
                        <div class='input-group c-search'>
                            <input type='text' class='form-control' id='contact-list-search'>
                            <span class='input-group-btn'>
                                <button class='btn btn-default' type='button'><span class='glyphicon glyphicon-search text-muted'></span></button>
                            </span>
                        </div>
                    </div>
                </div><ul class='list-group' id='contact-list'>
";
  foreach ($id_chatroom as $val) {
    $nama="";
    $count_user=0;
    foreach ($chatroom as $key) {
      if($val->id_chatroom==$key->id)
      {
        $nama=$nama." ".$key->nama;
        $date=$key->date;
        $count_user++;
        if($key->iduser!=$user[0]->iduser)
        {
          $gambar=$key->gambar;
        }
      }
    }
    echo "<li class='list-group-item'>";
  if($count_user>2)
  {
    echo "<div class='col-xs-12 col-sm-3'><img class='zoom' src='".base_url('uploads/group.png')."' width=70 height=70>
    </div>";
  }
  else {
      echo "<div class='col-xs-12 col-sm-3'><img class='zoom' src='".base_url('uploads/'.$gambar)."' width=70 height=70>
      </div>";
  }
      echo                  "<div class='col-xs-12 col-sm-9'>
                            <span class='name'>".$nama." ".form_submit('btnOpen['.$val->id_chatroom.']','open',array('class'=>'btn btn-default'))."</span>
                            <br><small class='text-muted'>".$date."</small>
                            <br/>
                        </div>
                        <div class='clearfix'></div>
                    </li>";
  }

  if(isset($friend))
  {
    echo "<h4>List friend to chat</h4>";
    foreach ($friend as $key) {
      if($key->iduser1==$user[0]->iduser)
      {
          echo "<img class='zoom' src='".base_url("uploads/".$key->gambar2)."' width=70 height=70>";
          echo $key->namaduser2." ".form_submit('btnChat['.$key->iduser2.']','Chat',array('class'=>'btn btn-default'))."<br>";
      }
      else {
          echo "<img class='zoom' src='".base_url("uploads/".$key->gambar1)."' width=70 height=70>";
          echo $key->namaduser1." ".form_submit('btnChat['.$key->iduser1.']','Chat',array('class'=>'btn btn-default'))."<br>";
      }
    }
  }
  else {
    echo "<br>";
    echo form_submit('btnNewChat','New Chat',array('class'=>'btn btn-default'));
    echo form_submit('btnNewPrivateChat','Private Chat',array('class'=>'btn btn-default'));
  }

	echo form_close();
  echo "<br>";
?>
<script src="<?php echo base_url();?>jquery.js"></script>
<script>
$(document).ready(function(){
    $('.zoom').click(function() {

        $(this).addClass('transisi');
    });
    $('.zoom').mouseleave(function() {
        $(this).removeClass('transisi');
    });
});
</script>
</body>
</html>
<?= $links; echo "</ul></div></div></div></div>";?>
