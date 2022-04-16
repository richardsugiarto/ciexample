<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
  <script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>
</head>
<style>
img.zoom {
    width: 200px;
    height: 100px;
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
<?php echo "<h2 style='text-align:right'>".$user[0]->namad." ".$user[0]->namab."</h2>";?>
<br>

<?php

  echo form_open_multipart('cont/index');

  if($isprivate[0]->isprivate=='0')
  {
  if(isset($friend))
  {
    echo "<h4>Invite friend to chat</h4>";
    foreach ($friend as $key) {
          if($key->iduser1==$user[0]->iduser)
          {
            echo $key->namaduser2." ".form_submit('btnInvite['.$key->iduser2.']','Invite',array('class'=>'btn btn-primary'))."<br>";
          }
          else if($key->iduser1!=$user[0]->iduser){
            echo $key->namaduser1." ".form_submit('btnInvite['.$key->iduser1.']','Invite',array('class'=>'btn btn-primary'))."<br>";
          }
    }
  }
  else {
    echo "<br>";
    echo form_submit('btnInviteChat','Invite',array('class'=>'btn btn-primary'));
  }
  echo "<br><div class='col-sm-3'></div>
  <div class='col-sm-7'>
  <div class='panel panel-info pb-chat-panel'>
                                      <div class='panel panel-heading pb-chat-panel-heading'>
                                          <div class='row'>
                                              <div class='col-xs-12'>
                                                  <a href=''>
                                                      <label id='support_label'>Chat room</label>
                                                  </a>
                                              </div>
                                          </div>
                                      </div><div class='panel-body'>";
  foreach ($id_chat as $val) {
    foreach ($chat as $key) {
      if($val->id_chat==$key->idchat&&$key->idr==$user[0]->iduser)
      {
        if($key->idc==$user[0]->iduser&&$key->isvisible=='1')
        {
            echo "<div class='form-group pull-left pb-chat-labels-left'>
                <span class='fa fa-lg fa-user pb-chat-fa-user'>"."<img class='img-circle avatar avatar-original' style='-webkit-user-select:none;
                display:block; margin:auto;' src='".base_url('uploads/'.$key->gambar)."' height=30 width=30>"."</span><span class='label label-primary pb-chat-labels pb-chat-labels-primary'>".$key->nama." ".form_submit('btnDeleteChat['.$key->idchat.']','x')."<br>".$key->chat."</span></div>";
            if($key->gambarchat!="")
            {
              echo "<img class='zoom' src='".base_url('uploads/'.$key->gambarchat)."' width=200 height=100>";
            }
            echo "<div class='clearfix'></div><hr>";
        }
        else if($key->idc!=$user[0]->iduser&&$key->isvisible=='1'){
          if($key->isread==1)
          {
            echo "<div class='form-group pull-right pb-chat-labels-right'>
                <span class='fa fa-lg fa-user pb-chat-fa-user'>"."<img class='img-circle avatar avatar-original' style='-webkit-user-select:none;
                display:block; margin:auto;' src='".base_url('uploads/'.$key->gambar)."' height=30 width=30>"."</span><span class='label label-default pb-chat-labels pb-chat-labels-left'>".$key->nama." ".form_submit('btnDeleteChat['.$key->idchat.']','x')."<br>".$key->chat."</span></div>";
            if($key->gambarchat!="")
            {
              echo "<img class='zoom' src='".base_url('uploads/'.$key->gambarchat)."' width=200 height=100>";
            }
            echo "<div class='clearfix'></div><hr>";
          }
          else {
            echo "<div class='form-group pull-right pb-chat-labels-right'>
                <span class='fa fa-lg fa-user pb-chat-fa-user'>"."<img class='img-circle avatar avatar-original' style='-webkit-user-select:none;
                display:block; margin:auto;' src='".base_url('uploads/'.$key->gambar)."' height=30 width=30>"."</span><span class='label label-default pb-chat-labels pb-chat-labels-left'>".$key->nama." ".form_submit('btnDeleteChat['.$key->idchat.']','x')."<br>".$key->chat."</span></div>";
            if($key->gambarchat!="")
            {
              echo "<img class='zoom' src='".base_url('uploads/'.$key->gambarchat)."' width=200 height=100>";
            }
            echo "<div class='clearfix'></div><hr>";
          }
        }
      }
    }
  }
  echo "</div>";
  echo "<div class='panel-footer'>
      <div class='row'>";
  echo "<div class='col-xs-10'>";
  echo form_textarea(array('name'=>'chat','class'=>'form-control pb-chat-textarea','placeholder'=>'Type Your Message Here'))."</div>";
  echo "<div class='col-xs-2 pb-btn-circle-div'>";
  echo form_submit('btnSend['.$id_chatroom.']','Send',array('class'=>'btn btn-primary'));
  if(isset($chat)&&$chat!=null)
  {
    echo form_submit('btnEndChat['.$id_chatroom.']','End Chat',array('class'=>'btn btn-primary'));
  }
  echo "</div></div>".form_upload(array('class'=>'btn btn-primary','name'=>'gambar'))."</div>";
}
else {
  if(isset($friend))
  {
    echo "<h4>Invite friend to chat</h4>";
    foreach ($friend as $key) {
          if($key->iduser1==$user[0]->iduser)
          {
            echo $key->namaduser2." ".form_submit('btnInvite['.$key->iduser2.']','Invite',array('class'=>'btn btn-primary'))."<br>";
          }
          else if($key->iduser1!=$user[0]->iduser){
            echo $key->namaduser1." ".form_submit('btnInvite['.$key->iduser1.']','Invite',array('class'=>'btn btn-primary'))."<br>";
          }
    }
  }
  else {
    echo "<br>";
    echo form_submit('btnInviteChat','Invite',array('class'=>'btn btn-primary'));
  }
  echo "<br><div class='col-sm-3'></div>
  <div class='col-sm-7'>
  <div class='panel panel-info pb-chat-panel'>
                                      <div class='panel panel-heading pb-chat-panel-heading'>
                                          <div class='row'>
                                              <div class='col-xs-12'>
                                                  <a href=''>
                                                      <label id='support_label'>Chat room</label>
                                                  </a>
                                              </div>
                                          </div>
                                      </div><div class='panel-body'>";
  echo "<table>";
  foreach ($_COOKIE as $key => $value) {
    $pecah=explode('*',$value);
    if(count($pecah)>0)
    {
      if($pecah[0]=="chat")
      {
        if($pecah[1]==$id_chatroom)
        {
          if($pecah[2]==$user[0]->iduser)
          {
            echo "<div class='form-group'>
                <span class='fa fa-lg fa-user pb-chat-fa-user'></span><span class='label label-primary pb-chat-labels pb-chat-labels-primary'>".$pecah[4]."<br>".$pecah[3]."</span>
            </div><div class='clearfix'></div><hr>";
          }
          else {
            echo "<div class='form-group pull-right pb-chat-labels-right'>
                <span class='fa fa-lg fa-user pb-chat-fa-user'></span><span class='label label-default pb-chat-labels pb-chat-labels-left'>".$pecah[4]."<br>".$pecah[3]."</span>
            </div><div class='clearfix'></div><hr>";
          }
        }
      }
    }
  }
  echo "</div>";
  echo "</table>";
  echo "<div class='panel-footer'>
      <div class='row'>";
  echo "<div class='col-xs-10'>";
  echo form_textarea(array('name'=>'chatprivate','class'=>'form-control pb-chat-textarea','placeholder'=>'Type Your Message Here'))."</div>";
  echo "<div class='col-xs-2 pb-btn-circle-div'>";
  echo form_submit('btnSendprivate['.$id_chatroom.']','Send',array('class'=>'btn btn-primary'))."<br>";
  echo form_submit('btnEndChat['.$id_chatroom.']','End Chat',array('class'=>'btn btn-primary'));
  echo "</div></div></div>";
}
	echo form_close();
  echo "</div>
</div>
<div class='col-sm-3'></div>";
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
