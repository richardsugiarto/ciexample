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
echo "<h1>EXPLORE PAGE</h1>";
$arr=array('username'=>'username','totallike'=>'totallike','totalcomment'=>'totalcomment','totalpost'=>'totalpost');
echo "Search : ".form_input(array('id'=>'txtsrc','name'=>'textsearch','placeholder'=>'search'))." ".form_submit('btnsearch','Search',array('class'=>'btn btn-default'))."<br>";
echo "Sort by : ".form_dropdown('sort',$arr)." ".form_dropdown('urut',array('asc'=>'asc','desc'=>'desc'))." ".form_submit('sorting','SORT',array('class'=>'btn btn-default'))." ".form_submit('reset','RESET',array('class'=>'btn btn-default'))."<br>";
if(isset($error))
{
  echo "<font style='color:red'>".$error."</font>";
}
echo "<div id='hasilsearch'>";
  foreach ($listuser as $val) {
    if($val->email!=$user[0]->email)
    {
      $jmlpost=0;
      foreach ($post as $key) {
        if($key->iduser==$val->iduser)
        {
          $jmlpost++;
        }
      }
      $i=$jmlpost;
      $lastpost="";
      foreach ($post as $key) {
        if($key->iduser==$val->iduser)
        {
          $i--;
          if($i==0)
          {
            $lastpost=$key->isi;
          }
        }
      }
      echo "<h4>";
      foreach ($like as $key) {
        if($key->email==$val->email)
        {echo "<div class='row'><div class='col-sm-3'></div><div class='container'>
        <div class='row'>
          <div class='col-sm-7'>
            <div class='panel panel-default'>
              <div class='panel-body'>
                <div class='row'>
                <div class='col-md-12 lead'>User Profile<hr></div>
                </div>";
        echo "<div class='row'>
      			<div class='col-md-4 text-center'>
                    <img class='img-circle avatar avatar-original' style='-webkit-user-select:none;
                    display:block; margin:auto;' src='".base_url('uploads/'.$key->gambar)."' width=200 height=200>
                  </div>
                  <div class='col-md-8'>
                    <div class='row'>
                      <div class='col-md-12'>
                        <h1 class='only-bottom-margin'>".$val->email."</h1>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-md-6'>
                        <span class='text-muted'>User:</span><a href=\"".site_url('cont/profiluserlain')."?activeuser=".$user[0]->email."&userlain=".$val->iduser."\">".$val->email."</a><br>
                        <span class='text-muted'>Total Jumlah Like:</span> ".$key->jml."<br>";
        }
      }
      echo "<span class='text-muted'>Total Post:</span> ".$jmlpost."<br>
      <span class='text-muted'>Last Post:</span> ".$lastpost."<br><br>";
      echo "<small class='text-muted'>Created: 11.09.2017</small>
      </div>
    </div>
    </div>
    </div>";
      $boolfriend=0;
      foreach ($friend as $row) {
        if(($row->iduser1==$user[0]->iduser && $row->iduser2==$val->iduser)||($row->iduser1==$val->iduser && $row->iduser2==$user[0]->iduser))
        {
          if($row->status=="1")
          {
            echo "<div class='row'><div class='col-md-12'>
              <hr>Menunggu Request
            </div></div>
          ";
            $boolfriend=1;
          }
          else if($row->status=="2")
          {
            echo "<div class='row'><div class='col-md-12'>
              <hr>".form_submit($row->idfriend,'UnFriend',array('class'=>'btn btn-default pull-right'))."
            </div></div>
          ";
            $boolfriend=1;
          }
        }
      }
      if($boolfriend==0)
      {
        echo "<div class='row'><div class='col-md-12'>
          <hr>".form_submit($val->iduser,'AddFriend',array('class'=>'btn btn-default pull-right'))."
        </div></div>
      ";
      }

      echo "<br><br>";
      echo "</h4>";
    }
    echo "</div></div></div>";
  }
  echo form_hidden('halaman','explore',array('class'=>'btn btn-default'));
	echo form_close();
?>
<?=$links?>
</div>
</body>
<script src="<?php echo base_url();?>jquery.js"></script>
<script>
$(document).ready(function(){

    $("input[name='textsearch']").keypress(function()
    {
        /*$(".row").empty();
        $(".pagination").empty();
        $("#hasilsearch").empty();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('cont/ajaxpagination') ?>",
            data: {src: $("input[name='textsearch']").val()},
            dataType: "text",
            cache:false,
            success:
                 function(data){
                   $(this).replaceWith(data);
                    //alert(data);  //as a debugging message.
                 }
             });// you have missed this bracket*/
    });
 });
</script>


</html>
