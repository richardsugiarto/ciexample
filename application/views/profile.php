<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
  <script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>

</head>
<body>
<script type = 'text/javascript'>
 <?php
  echo "var countDownDate = new Array();";
  echo "var idpost = new Array();";
  foreach ($_COOKIE as $key => $value) {
    $pecah=explode('*',$value);
    if(count($pecah)>0)
    {
      if($pecah[0]=="post")
      {
        if($pecah[1]==$user[0]->iduser)
        {
          $hour=$pecah[3]+floor(($pecah[4]+2)/60);
          $minute=($pecah[4]+2)%60;
          echo "
          idpost.push(".$key.");
          countDownDate.push(new Date().setHours(".$hour.",".$minute.",".$pecah[5].",0));
          ";
        }
      }
    }
  }
  echo "

    setInterval(function() {
      for(var i=0;i<idpost.length;i++)
      {
        var now = new Date().getTime();
        var skr = countDownDate[i];
        var distance =skr-now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if(distance>0)
        {
            document.getElementById(idpost[i]).innerHTML = minutes+'m '+ seconds+'s';
        }
      }
  }, 1000);";
  ?>
</script>
<ul class="nav nav-tabs">
  <li><a href="<?php echo site_url('cont/profile')."?activeuser=".$user[0]->email;?>">Profile</a></li>
  <li><a href="<?php echo site_url('cont/explore')."?activeuser=".$user[0]->email;?>">Explore</a></li>
  <li><a href="<?php echo site_url('cont/newsfeed')."?activeuser=".$user[0]->email;?>">NewsFeed</a></li>
  <li><a href="<?php echo site_url('cont/notif')."?activeuser=".$user[0]->email;?>">Notification</a></li>
  <li><a href="<?php echo site_url('cont/chat')."?activeuser=".$user[0]->email;?>">Chat</a></li>
  <li><a href="<?php echo site_url('cont/shop')."?activeuser=".$user[0]->email;?>">Shop</a></li>
</ul>
<?php
if($user[0]->music!="")
{
echo "<audio controls autoplay>";
echo "<source src='".base_url('uploads/'.$user[0]->music)."'>";
echo "</audio>";}?>
<?php
if($this->session->flashdata('message'))
{
  echo "<font style='color:red'>".$this->session->flashdata('message')."</font>";
}
echo form_open_multipart('cont/index');
  echo "<h2 style='text-align:right'>".$user[0]->namad." ".$user[0]->namab."</h2>";
  echo "<div class='col-sm-10'></div>".form_submit('btnLogout','Log out',array('class'=>'btn btn-default'));
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
              display:block; margin:auto;' src='".base_url('uploads/'.$user[0]->gambar)."' width=200 height=200>
            </div>
            <div class='col-md-8'>
              <div class='row'>
                <div class='col-md-12'>";
                if($user[0]->verified==1)
                {
                echo"  <h1 class='only-bottom-margin'>".$user[0]->namad." ".$user[0]->namab."<img src='".base_url('uploads/verified.jpg')."' width=30 height=30></h1>";
              }
              else {
                echo"  <h1 class='only-bottom-margin'>".$user[0]->namad." ".$user[0]->namab."</h1>";
              }
                echo "</div>
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <span class='text-muted'>Email:</span> ".$user[0]->email."<br>
                  <span class='text-muted'>Nomor Hp:</span> ".$user[0]->hp."<br>
                  <span class='text-muted'>Jabatan:</span> ".$user[0]->jabatan."<br>
                  <span class='text-muted'>Perusahaan:</span> ".$user[0]->perusahaan."<br>
                  <span class='text-muted'>Bio perusahaan:</span> ".$user[0]->bioperusahaan."<br>
                  <span class='text-muted'>Bio User:</span> ".$user[0]->biouser."<br><br>";

  if(isset($skill))
  {
    echo "<h2>Skill Section</h2>";
    foreach ($skill as $key) {

      foreach ($endorse as $val) {
        if($key->id_skill==$val->idskill)
        {
            echo "Skill : "."<br>".$key->nama_skill."<br>"."Jumlah endorsement : ".$val->jmlendorse."<br><br>";
        }
      }
    }
  }
  echo form_submit('btnseeallskill','See all Skill',array('class'=>'btn btn-deafult'))."<br><br>";
  echo "<small class='text-muted'>Created: 11.09.2017</small>
  </div>
</div>
</div>
</div>";
//echo form_submit('btnEditprofile','Edit Profile',array('class'=>'btn btn-default'));
//echo form_submit('btnEditaccount','Edit Account',array('class'=>'btn btn-default'));
echo "<div class='row'>
            <div class='col-md-12'>
              <hr>".form_submit('btnEditprofile','Edit Profile',array('class'=>'btn btn-default pull-right'))."
              ".form_submit('btnEditaccount','Edit Account',array('class'=>'btn btn-default pull-right'))."
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><div class='col-sm-3'></div>
</div>";
echo "<div class='row'><div class='col-sm-4'></div><div class='col-sm-8'>";
	echo "<h4>Create New Post<br>";
	echo form_textarea(array('name'=>'post','class'=>'pb chat-textarea','placeholder'=>'Type your post  here...'))."<br>";
	echo form_submit('btnpost','Posting',array('class'=>'btn btn-default')).form_submit('btntimepost','Time Posting',array('class'=>'btn btn-default'))."<br>";
  echo form_upload(array('class'=>'btn btn-default','name'=>'gambar'));
  echo "</div><div class='col-sm-2'></div></div>";
	$index["id"]="a";
	//echo form_submit('btndelete['.$user[0]->hp.']','-X-')."<br><br>";
  $allcomment=0;
  $allliked=0;
  //echo "<table>";
  foreach ($_COOKIE as $key => $value) {
    $pecah=explode('*',$value);
    if(count($pecah)>0)
    {
      if($pecah[0]=="post")
      {
        echo "<div class='row'>
<div class='col-sm-3'></div>
<div class='col-sm-7'>
<div class='container'>
	<div class='col-md-5'>
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
                              </div><div class='media-body'>
                                <a href='#' class='anchor-username'><h4 class='media-heading'>".$user[0]->namad." ".$user[0]->namab."</h4></a>";
        if($pecah[1]==$user[0]->iduser)
        {
          echo "<a href='#' class='anchor-time'><p id='".$key."'>51 mins</p></a>
                              </div>
                            </div>
                        </div>
                    </div>
               </section>
               <section class='post-body'>
                   <p>".$pecah[2]."</p>
               </section>";
          //echo "<tr><td>Time Post : <br>".$pecah[2]."<br></td></tr>";
          //echo "<tr><td><p id='".$key."'></p></td></tr>";
          echo "</div></div></div></div></div><div class='col-sm-3'></div></div>";
        }
      }
    }
  }
	foreach ($post as $row) {
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
                                    <a href='#' class='anchor-username'><h4 class='media-heading'>".$user[0]->namad." ".$user[0]->namab."</h4></a>
                                    ".form_submit($row->id_post,'X',array('class'=>'btn btn-primary'))."
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
    //echo "<tr><td>Postingan : ".form_submit($row->id_post,'X')."<br>".$isi."</td>";
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
      //echo "<tr><td>".form_submit($row->id_post,'Like')."</td></tr>";
    }
    else
    {
      echo "<section class='post-footer'> <div class='post-footer-option container'>
                          ".form_submit($row->id_post,'Unlike',array('class'=>'btn btn-primary'))."
                     </div>
                     <hr>";
      //echo "<tr><td>".form_submit($row->id_post,'Unlike')."</td></tr>";
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
                                ".form_submit($val->idcomment,'X',array('class'=>'btn btn-primary'));
          //echo "<tr><td></td><td>Commend from ".$val->email."</td><td>".form_submit($val->idcomment,'X')."</td></tr>";
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
                                     <button name=\"ajaxliked\" id='".$row->id_post."' class='btn btn-primary'>Like by ".$liked." people</button><br>
                                     <div id='ajax_success'></div>
                                 </div>";
    //echo "<tr><td>Commend : </td></tr>";
    //echo "<tr><td>".form_input($row->id_post."1")." </td></tr>";
    //echo "<tr><td>".form_submit($row->id_post,'Comment',array('class'=>'btn btn-primary'))." </td></tr>";

    echo "</div>
</div>
</div>
</div>
<div class='col-sm-3'></div></div>";
	}
  //echo "</table>";

  echo "<div class='row'><div class='col-sm-3'></div><div class='col-sm-6'>";
  echo "</h4>";
  echo "<h2>Total Comment : ".$allcomment."<br>";
  echo "Total Like : ".$allliked."</h2><br>";
	echo form_close();
?>
<?=$links?>
</div><div class='col-sm-3'></div></div>
<script src="<?php echo base_url();?>jquery.js"></script>
<script>
$(document).ready(function(){

    $("button[name='ajaxliked']").click(function()
    {
     $.ajax({
         type: "POST",
         url: "<?php echo site_url('cont/ajaxlike') ?>",
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
