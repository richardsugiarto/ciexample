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
echo form_open_multipart('cont/index');
echo "<div class='col-sm-10'></div>".form_submit('btnLogout','Log out',array('class'=>'btn btn-default'));
foreach ($all_friend as $all) {
  echo "<div class='container'>
  <div class='row'>
  <div class='col-sm-3'></div>
    <div class='col-sm-7'>
      <div class='panel panel-default'>
        <div class='panel-body'>
          <div class='row'>
          <div class='col-md-12 lead'>User Profile<hr></div>
          </div>";
  echo "<div class='row'>
            <div class='col-md-4 text-center'>
              <img class='img-circle avatar avatar-original' style='-webkit-user-select:none;
              display:block; margin:auto;' src='".base_url('uploads/'.$all->gambar)."' width=200 height=200>
            </div>
            <div class='col-md-8'>
                <div class='row'>
                  <div class='col-md-12'>
                    <h1 class='only-bottom-margin'>".$all->namad." ".$all->namab."</h1>
                  </div>
                </div>
              <div class='row'>
                <div class='col-md-6'>
                  <span class='text-muted'>Email:</span> ".$all->email."<br>
                  <span class='text-muted'>Nomor Hp:</span> ".$all->hp."<br>
                  <span class='text-muted'>Jabatan:</span> ".$user[0]->jabatan."<br>
                  <span class='text-muted'>Perusahaan:</span> ".$all->perusahaan."<br>
                  <span class='text-muted'>Bio perusahaan:</span> ".$all->bioperusahaan."<br>
                  <span class='text-muted'>Bio User:</span> ".$all->biouser."<br><br>";
  echo "<small class='text-muted'>Created: 11.09.2017</small>
  </div></div></div></div></div></div><div class='col-sm-3'></div></div>";
	echo "</h3>";
	$index["id"]="a";


  $allcomment=0;
  $allliked=0;
  //echo "<table>";
	foreach ($post as $row) {
    if($row->iduser==$all->iduser)
    {
      echo "<div class='row'><div class='col-sm-3'></div>
      <div class='col-sm-6'>
      <div class='container'>
      	<div class='col-md-7'>
              <div class='panel panel-default'>
                  <div class='panel-body'>
                     <section class='post-heading'>
                          <div class='row'>
                              <div class='col-md-11'>
                                  <div class='media'>
                                    <div class='media-left'>
                                      <a href='#'>
                                        <img class='media-object photo-profile' src='' width='40' height='40' alt='...'>
                                      </a>
                                    </div>
                                    <div class='media-body'>
                                      <a href='#' class='anchor-username'><h4 class='media-heading'>".$all->namad." ".$all->namab."</h4></a>
                                      ".form_submit($row->id_post,'X',array('class'=>'btn btn-primary')).form_submit('btnShared['.$row->id_post.']','Share',array('class'=>'btn btn-primary'))."
                                    </div>
                                  </div>
                              </div>
                          </div>
                     </section>";
      $liked=0;
      $pecah=explode(' ',$row->isi);
      $a=0;
      for ($i=0; $i <count($pecah) ; $i++) {
        $temp=$pecah[$i];
        if($temp[0]=="@")
        {
          $a=$i;
        }
      }
      $isi="";
      for ($i=0; $i <count($pecah) ; $i++) {
          $temp=$pecah[$i];
        if($temp[0]!="@")
        {
          $isi=$isi." ".$pecah[$i];
        }
        else
        {
          $pecahemail=explode('@',$pecah[$a]);
          $email="";
          if(isset($pecahemail[2]))
          {
            $email=$pecahemail[1]."@".$pecahemail[2];
          }
          $boolvalue=0;
          foreach ($all_user as $value) {
            if($value->email==$email)
            {
              $boolvalue=1;
            }
          }
          if($boolvalue==1)
          {
            $isi=$isi." <a href='".site_url('cont/mentionuserlain')."?activeuser=".$user[0]->email."&emailuserlain=".$email."'>".$pecah[$a]."</a>";
          }
          else {
            $isi=$isi." ".$pecah[$a];
          }

        }
      }
      echo "<section class='post-body'>
                     <p>".$isi."</p><br>";
      if($row->gambar!="")
      {
        echo "<img src='".base_url('uploads/'.$row->gambar)."' width=200 height=100>";
      }
      echo "</section>";
  		//echo "<tr><td>Postingan :<br>".$isi."</td>";
      //echo "<td>".form_submit('btnShared['.$row->id_post.']','Share',array('class'=>'btn btn-default'))."</td>";
      $isliked=0;
      foreach ($like as $key) {
        if($key->id_post==$row->id_post)
        {
          $liked=$liked+1;
          $allliked++;
        }
        //boolean like and unlike
        if($key->id_post==$row->id_post&&$key->iduser==$user[0]->iduser)
        {
          $isliked=1;
        }
      }
      if($isliked==0)
      {
        echo "<section class='post-footer'> <div class='post-footer-option container'>
                            ".form_submit($row->id_post,'Like',array('class'=>'btn btn-primary'))."
                       </div>
                       <hr>";
        //echo "<tr><td>".form_submit($row->id_post,'Like',array('class'=>'btn btn-default'))."</td></tr>";
      }
      else
      {
        echo "<section class='post-footer'> <div class='post-footer-option container'>
                            ".form_submit($row->id_post,'Unlike',array('class'=>'btn btn-primary'))."
                       </div>
                       <hr>";
        //echo "<tr><td>".form_submit($row->id_post,'Unlike',array('class'=>'btn btn-default'))."</td></tr>";
      }
      echo "<div class='post-footer-comment-wrapper'>
                         <div class='comment'>";
      foreach ($comment as $val) {
        if($row->id_post==$val->id_post)
        {
          if($val->email==$user[0]->email)
          {
            echo "<div class='media'>
                                <div class='media-left'>
                                  <a href='#'>
                                    <img class='media-object photo-profile' src='' width='32' height='32' alt='...'>
                                  </a>
                                </div>
                                <div class='media-body'>
                                  <a href='#' class='anchor-username'><h4 class='media-heading'>".$val->email."</h4></a>
                                  ";
            //echo "<tr><td></td><td>Commend from ".$val->email."</td><td>".form_submit($val->idcomment,'X',array('class'=>'btn btn-default'))."</td></tr>";
          }
          else {
            echo "<div class='media'>
                                <div class='media-left'>
                                  <a href='#'>
                                    <img class='media-object photo-profile' src='' width='32' height='32' alt='...'>
                                  </a>
                                </div>
                                <div class='media-body'>
                                  <a href='#' class='anchor-username'><h4 class='media-heading'>".$val->email."</h4></a>
                                  ";
            //echo "<tr><td></td><td>Commend from ".$val->email."</td></tr>";
          }
          if($val->gambar!="")
          {
            echo "<p>".$val->isicomment."</p><img src='".base_url('uploads/'.$val->gambar)."' width=200 height=100>
          </div>
        </div>";
      }
      else {
        echo "<p>".$val->isicomment."</p>
      </div>
    </div>";
  }
          //echo "<tr><td></td><td>&nbsp&nbsp&nbsp*".$val->isicomment."</td></tr>";
          $allcomment++;
        }
      }
      echo "</div>
      </div>
      </section>
      </div>";

      echo "<div class='panel-footer'>
                                       <div class='row'>
                                           <div class='col-xs-10'>
                                              ".form_textarea(array('name'=>$row->id_post.'1','class'=>'form-control pb-chat-textarea','placeholder'=>'Type your comment  here...'))."
                                           </div>
                                           <div class='col-xs-2 pb-btn-circle-div'>
                                                ".form_submit($row->id_post,'Comment',array('class'=>'btn btn-primary'))."
                                           </div>
                                       </div>
                                       <div id='filearea'>
                                       <button name='upload'>Upload Picture</button>
                                       </div>
                                       Like by ".$liked." people
                                   </div>";
    //  echo "<tr><td>Commend : </td></tr>";
      //echo "<tr><td>".form_input($row->id_post."1")." </td></tr>";
    //  echo "<tr><td>".form_submit($row->id_post,'Comment',array('class'=>'btn btn-default'))." </td></tr>";


      //echo "<tr><td>Like by ".$liked." people</td></tr>";
      echo "</div>
    </div>
    </div>
    </div>
    <div class='col-sm-3'></div></div>";
    }

  }

  echo "<div class='row'>
    <div class='col-md-3 col-md-offset-5'>";
      //echo "</table>";
      //echo "</h4>";
      echo "<h2>Total Comment : ".$allcomment."<br>";
      echo "Total Like : ".$allliked."</h2><br>";
  echo "</div></div>";
}
	echo form_close();
?>
<?=$links?>
<script src="<?php echo base_url();?>jquery.js"></script>
<script>
$(document).ready(function(){

    $("button[name='upload']").click(function()
    {
     $.ajax({
         type: "POST",
         url: "<?php echo site_url('cont/ajaxupload') ?>",
         data: {id: '0'},
         dataType: "text",
         cache:false,
         success:
              function(data){
                $('#filearea').replaceWith(data);
                //alert(data);  //as a debugging message.
              }
          });// you have missed this bracket
     return false;
 });
 });
</script>
</body>
</html>
