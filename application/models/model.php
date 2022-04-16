<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model extends CI_Model {


	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
public function count_all()
 {
  $query = $this->db->get("user");
  return $query->num_rows();
 }

 public function fetch_details($limit, $start)
 {
  $output = '';
  $this->db->select("*");
  $this->db->from("user");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  $output .= '
  <table class="table table-bordered">
   <tr>
    <th>User ID</th>
    <th>Nama Depan</th>
   </tr>
  ';
  foreach($query->result() as $row)
  {
   $output .= '
   <tr>
    <td>'.$row->iduser.'</td>
    <td>'.$row->namad.'</td>
   </tr>
   ';
  }
  $output .= '</table>';
  return $output;
 }

//PROFILE SITEE----------------
  public function insert_user1($namad,$namab,$email,$hp,$password)
  {
		$data=array('namad' => $namad,'namab' => $namab,'email' => $email,'hp' => $hp,'password' => $password,'status' => '0');
		$this->db->insert('user',$data);
    return $this->db->affected_rows();
  }

  public function insert_user2($alamat,$kodepos,$negara,$jabatan,$perusahaan,$bioperusahaan,$biouser,$private,$music='',$gambar='')
  {
		$data=array('gambar'=>$gambar,'music'=>$music,'alamat' => $alamat,'kodepos' => $kodepos,'negara' => $negara,'jabatan' => $jabatan,'perusahaan' => $perusahaan,'bioperusahaan' => $bioperusahaan,'biouser' => $biouser,'isprivate' => $private);
		$this->db->where('status','0');
		$this->db->update('user',$data);
		$this->db->update('user',array('status' => '1'));
  }

  public function seteditaccount($email)
  {
		$this->db->where('email',$email)->update('user',array('status'=>'0'));
  }

  public function unseteditaccount($email)
  {
		$this->db->where('email',$email)->update('user',array('status'=>'1'));
  }

  public function update_user1($namad,$namab,$email,$hp,$password,$id)
  {
		$this->db->where('iduser',$id[0]->iduser)->update('comment',array('email'=>$email));
		$this->db->where('iduser',$id[0]->iduser)->update('like',array('email'=>$email));
		$data=array('namad' => $namad,'namab' => $namab,'email' => $email,'hp' => $hp,'password' => $password);
		$this->db->where('status','0')->update('user',$data);
  }

	public function getuser($id)
	{
		return $this->db->select("*")->from("user")->where("iduser",$id)->get()->result();
	}

  public function selectuser()
  {
		return $this->db->get('user')->result();
  }

  public function login($where)
  {
		return $this->db->select('*')->from('user')->where("email",$where)->or_where("hp",$where)->get()->result();
  }

  public function getiduser($email)
  {
		return $this->db->select('iduser')->from('user')->where('email',$email)->get()->result();
  }

  public function newpost($isi,$iduser,$gambar="")
  {
		$this->db->insert('post',array('isi' => $isi,'iduser' => $iduser,'gambar'=>$gambar));
		$pecah=explode(' ',$isi);
		$a=0;
		for ($i=0; $i <count($pecah) ; $i++) {
			$temp=$pecah[$i];
			if($temp[0]=="@")
			{
				$a=$i;
			}
		}
		$asli=substr($pecah[$a],1);
		$userlain=$this->db->get_where('user',array('email'=>$asli))->result();
		if($a!=0)
		{
			$this->db->insert('notif',array('iduser'=>$userlain[0]->iduser,'iduser2'=>$iduser,'isinotif'=>'Mention','status'=>'0'));
		}
	}
	public function getspecificpost($where)
	{
		return $this->db->select('*')->from('post')->where('id_post',$where)->get()->result();
	}
  public function showpost($where)
  {
		return $this->db->select('*')->from('post')->where('iduser',$where)->get()->result();
  }

	public function showallpost()
	{
		return $this->db->get('post')->result();
	}

	public function showfriendpost($friend)
	{
		return $this->db->select('*')->from('post')->where_in('iduser',$friend)->get()->result();
	}

	public function deletepost($id)
	{
		$this->db->where('id_post',$id)->delete('post');
	}

	public function showcomment()
	{
		return $this->db->get('comment')->result();
	}

	public function insertcomment($id_post,$isicomment,$iduser,$email,$iduser2,$gambar='')
	{
		$this->db->insert('comment',array('id_post' => $id_post,'isicomment' => $isicomment,'iduser' => $iduser,'email' => $email,'gambar'=>$gambar));
		$this->db->insert('notif',array('iduser'=>$iduser2,'iduser2'=>$iduser,'isinotif'=>'Komentar','status'=>'0'));
	}

	public function deletecomment($id)
	{
		$this->db->where('idcomment',$id)->delete('comment');
	}

	public function showlike()
	{
		return $this->db->get('like')->result();
	}

	public function insertlike($id_post,$iduser,$email,$iduser2)
	{
		$this->db->insert('like',array('id_post' => $id_post,'iduser' => $iduser,'email' => $email));
		$this->db->insert('notif',array('iduser'=>$iduser2,'iduser2'=>$iduser,'isinotif'=>'Like','status'=>'0'));
	}

	public function unlike($id_post,$iduser)
	{
		$this->db->where('id_post',$id_post)->where('iduser',$iduser);
		$this->db->delete('like');
	}

	public function likeajax($id_post)
	{
		return $this->db->select("u.namad as 'namad',u.namab as 'namab'")->from('like l')->join('user u','l.iduser=u.iduser')->where('l.id_post',$id_post)->get()->result();
	}
//end OF PROFILE SITEE----------------

	public function explore()
	{
		return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(p.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(p.id_post)','desc')->get()->result();
	}

	public function showuser($friend)
	{
		if($friend!=null)
		{
			return $this->db->select('*')->from('user')->where_in('iduser',$friend)->get()->result();
		}
	}
	public function showfriend()
	{
		return $this->db->get('friend')->result();
	}

	public function getfriend($where)
	{
		return $this->db->select("f.idfriend as 'idfriend',f.iduser1 as 'iduser1',f.iduser2 as 'iduser2',u1.namad as 'namaduser1',u2.namad as 'namaduser2',u1.gambar as 'gambar1',u2.gambar as 'gambar2'")->from('friend f')->join('user u1','u1.iduser=f.iduser1')->join('user u2','u2.iduser=f.iduser2')->where('f.iduser1',$where)->or_where('f.iduser2',$where)->where('f.status','2')->get()->result();
	}

	public function addfriend($id1,$id2)
	{
		$data=array('iduser1'=>$id1,'iduser2'=>$id2,'status'=>'1');
		$this->db->insert('friend',$data);
    $value=$this->db->select('*')->from('friend')->where('iduser1',$id1)->where('iduser2',$id2)->get()->result();
		$data1=array('iduser'=>$id2,'iduser2'=>$id1,'isinotif'=>'permintaan pertemanan','status'=>'0','idfriend'=>$value[0]->idfriend);
		$this->db->insert('notif',$data1);
	}

	public function updatefriend($id,$iduser1,$iduser2,$iduser)
	{
		$this->db->where('idfriend',$id)->update('notif',array('status'=>'1'));
		$this->db->where('idfriend',$id)->update('friend',array('status'=>'2'));
		if($iduser!=$iduser1)
		{
			$this->db->insert('notif',array('iduser'=>$iduser1,'iduser2'=>$iduser2,'isinotif'=>'Permintaan pertemanan disetujui','idfriend'=>$id,'status'=>'0'));
		}
		else {
			$this->db->insert('notif',array('iduser'=>$iduser2,'iduser2'=>$iduser1,'isinotif'=>'Permintaan pertemanan disetujui','idfriend'=>$id,'status'=>'0'));
		}
	}

	public function deletefriend($id)
	{
		$this->db->where('idfriend',$id)->delete('friend');
	}

	public function rejectfriend($id,$iduser1,$iduser2,$iduser)
	{
		$this->db->where('idfriend',$id)->delete('notif');
		$this->db->where('idfriend',$id)->delete('friend');
		if($iduser!=$iduser1)
		{
			$this->db->insert('notif',array('iduser'=>$iduser1,'iduser2'=>$iduser2,'isinotif'=>'Permintaan pertemanan ditolak','idfriend'=>$id,'status'=>'0'));
		}
		else {
			$this->db->insert('notif',array('iduser'=>$iduser2,'iduser2'=>$iduser1,'isinotif'=>'Permintaan pertemanan ditolak','idfriend'=>$id,'status'=>'0'));
		}
	}

	public function userlain($where)
	{
		return $this->db->select('*')->from('user')->where('iduser',$where)->get()->result();
	}

	public function shownotif($where)
	{
		return $this->db->select('*')->from('notif')->where('iduser',$where)->where('status','0')->get()->result();
	}
	//chatting site
	public function getidchatroom($where)
	{
		return $this->db->select("id_chatroom")->from("chatmember")->where("iduser",$where)->get()->result();
	}

	public function allchatroom()
	{
		return $this->db->get('chatroom')->result();
	}

	public function getallchatroom($where)
	{
		$stack=array();
		$id_chatroom=$this->db->select("id_chatroom")->from("chatmember")->where("iduser",$where)->get()->result();
		foreach ($id_chatroom as $key) {
			array_push($stack,$key->id_chatroom);
		}
		return $this->db->select("cr.id_chatroom as 'id',u.namad as 'nama',cr.date as 'date',u.gambar as 'gambar',cm.iduser as 'iduser'")->from("user u")->join("chatmember cm","cm.iduser=u.iduser")->join("chatroom cr","cr.id_chatroom=cm.id_chatroom")->where_in("cr.id_chatroom",$stack)->get()->result();
	}

	public function getallidchat($where)
	{
		return $this->db->select('id_chat')->from('chat')->where('id_chatroom',$where)->get()->result();
	}

	public function getallchat($where)
	{
		return $this->db->select("c.gambar as 'gambarchat',u.gambar as 'gambar',c.id_chatroom as 'id_chatroom',c.id_chat as 'idchat',r.iduser as 'idr',c.iduser as 'idc',u.namad as 'nama',c.chat as 'chat',r.isvisible as 'isvisible',r.isread as 'isread'")->from('chat c')->join('readchat r','r.id_chat=c.id_chat')->join('user u','c.iduser=u.iduser')->where('c.id_chatroom',$where)->get()->result();
		//return $this->db->get_where('chat',array('id_chatroom' => $where))->result();
	}

	public function deletemessagechat($iduser,$idchat)
	{
		$this->db->where('iduser',$iduser)->where('id_chat',$idchat)->update('readchat',array('isvisible' => '0'));
	}

	public function getisprivatechat($where)
	{
		return $this->db->get_where('chatroom',array('id_chatroom' => $where))->result();
	}

	public function newchatroom($id1,$id2,$private)
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->db->insert('chatroom',array('date'=>date('d-m-Y h:i:sa'),'isprivate'=>$private));
		$val=$this->db->select("max(id_chatroom) as 'max'")->from('chatroom')->get()->result();
		$this->db->insert('chatmember',array('id_chatroom'=>$val[0]->max,'iduser'=>$id1));
		$this->db->insert('chatmember',array('id_chatroom'=>$val[0]->max,'iduser'=>$id2));
	}
	public function updatereadchat($idchat,$iduser,$id_chatroom)
	{
		$this->db->where('id_chat',$idchat)->where('iduser',$iduser)->update('readchat',array('isread'=>'1'));
		$this->db->where('id_chatroom',$id_chatroom)->where('iduser',$iduser)->delete('notif');
	}
	public function insertchat($id_chatroom,$chat,$iduser,$gambar='')
	{
		  date_default_timezone_set('Asia/Jakarta');
			$this->db->insert('chat',array('gambar'=>$gambar,'id_chatroom' => $id_chatroom,'chat' => $chat,'iduser'=>$iduser,'tanggal'=>date('d-m-Y'),'waktu'=>date('h:i:sa')));
			$this->db->where('id_chatroom',$id_chatroom)->update('chatroom',array('date'=>date('d-m-Y h:i:sa')));
			$data=$this->db->select('*')->from('chatmember')->where('id_chatroom',$id_chatroom)->get()->result();
			$idchat=$this->db->select("max(id_chat) as 'max'")->from('chat')->where('id_chatroom',$id_chatroom)->get()->result();
			foreach ($data as $key) {
				if($key->iduser!=$iduser)
				{
					$this->db->insert('readchat',array('id_chat'=>$idchat[0]->max,'iduser'=>$key->iduser,'isread'=>'0','isvisible'=>'1'));
				}
				else {
					$this->db->insert('readchat',array('id_chat'=>$idchat[0]->max,'iduser'=>$key->iduser,'isread'=>'1','isvisible'=>'1'));
				}
			}
			$notif=$this->getChatMember($id_chatroom);
			foreach ($notif as $key) {
				if($key->iduser!=$iduser)
				{
					$this->db->insert('notif',array('iduser'=>$key->iduser,'iduser2'=>$iduser,'isinotif'=>'Read','status'=>'0','id_chatroom'=>$id_chatroom));
				}
			}
	}
	public function getChatMember($id_chatroom)
	{
		return $this->db->select('*')->from('chatmember')->where('id_chatroom',$id_chatroom)->get()->result();
	}

	public function InviteChat($iduser,$id_chatroom)
	{
		$data=$this->db->select('iduser')->from('chatmember')->where('iduser',$iduser)->where('id_chatroom',$id_chatroom)->get()->result();
		if($data==null)
		{
			$this->db->insert('chatmember',array('iduser'=>$iduser,'id_chatroom'=>$id_chatroom));
		}
	}

	public function endchat($id_chatroom,$iduser)
	{
			$data=$this->db->select("r.id_chat as 'id_chat'")->from('readchat r')->join('chat c','r.id_chat=c.id_chat')->where('c.id_chatroom',$id_chatroom)->where('r.iduser',$iduser)->get()->result();
			foreach ($data as $key) {
				$this->db->where('id_chat',$key->id_chat)->where('iduser',$iduser)->update('readchat',array('isvisible'=>'0'));
			}
			$this->db->where('id_chatroom',$id_chatroom)->where('iduser',$iduser)->delete('chatmember');
	}

	public function notiflihatprofile($iduserlain,$iduser)
	{
		$this->db->insert('notif',array('iduser'=>$iduserlain,'iduser2'=>$iduser,'isinotif'=>'lihatprofile','status'=>'0'));
	}

	//SKILL site
	public function getuserskill($where)
	{
		return $this->db->select("s.id_skill as 'id_skill',s.iduser as 'iduser',js.nama_skill as 'nama_skill',js.id_jnsskill as 'id_jnsskill'")->from('skill s')->join('jnsskill js','js.id_jnsskill=s.id_jnsskill')->where('iduser',$where)->get()->result();
	}

	public function getallendorsement()
	{
		return $this->db->get('endorsement')->result();
	}

	public function getalljenisskill()
	{
		return $this->db->get('jnsskill')->result();
	}

	public function insertskill($idjenis,$iduser)
	{
		$this->db->insert('skill',array('id_jnsskill' => $idjenis,'iduser' => $iduser));
	}

	public function newinsertskill($nama,$iduser)
	{
		$this->db->insert('jnsskill',array('nama_skill' => $nama));
		$data=$this->db->select("max(id_jnsskill) as 'maxid'")->from('jnsskill')->get()->result();
		$this->db->insert('skill',array('id_jnsskill' => $data[0]->maxid,'iduser' => $iduser));
	}

	public function deleteskill($idjenis)
	{
		$this->db->where('id_skill',$idjenis)->delete('endorsement');
		$this->db->where('id_skill',$idjenis)->delete('skill');
	}

	public function endorseajax($idskill)
	{
		return $this->db->select("e.iduser as 'iduser',u.namad as 'namad',u.namab as 'namab'")->from('endorsement e')->join('user u','e.iduser=u.iduser')->where('e.id_skill',$idskill)->get()->result();
	}

	public function getjumlahskill($iduser)
	{
		return $this->db->select("count(iduser) as 'jumlah'")->from('skill')->where('iduser',$iduser)->get()->result();
	}

	public function get3endorseskill($iduser)
	{
		return $this->db->select("e.id_skill as 'idskill',count(e.iduser) as 'jmlendorse',s.iduser as 'iduser'")->from('endorsement e')->join('skill s','s.id_skill=e.id_skill')->where('s.iduser',$iduser)->group_by('e.id_skill')->order_by('count(e.iduser)','desc')->order_by('e.id_endorsement','asc')->limit('3')->get()->result();
	}

	public function endorse($iduser,$idskill)
	{
		$this->db->insert('endorsement',array('id_skill'=>$idskill,'iduser'=>$iduser));
	}

	public function unendorse($iduser,$idskill)
	{
		$this->db->where('id_skill',$idskill)->where('iduser',$iduser)->delete('endorsement');
	}
	//PAGINATION
	public function fetch_chat($limit,$start,$where)
	{
		return $this->db->select("id_chatroom")->from("chatmember")->where("iduser",$where)->limit($limit,$start)->get()->result();
	}

	public function record_count_chat($where)
	{
		return $this->db->select("id_chatroom")->from("chatmember")->where("iduser",$where)->get()->num_rows();
	}
	public function fetch_post($limit,$start,$where)
	{
		return $this->db->select('*')->from('post')->where('iduser',$where)->limit($limit,$start)->get()->result();
	}

	public function record_count_post($where)
	{
		return $this->db->select('*')->from('post')->where('iduser',$where)->get()->num_rows();
	}

	public function fetch_newsfeed($limit,$start,$friend)
	{
		return $this->db->select('*')->from('post')->where_in('iduser',$friend)->limit($limit,$start)->get()->result();
	}

	public function record_count_newsfeed($friend)
	{
		return $this->db->select('*')->from('post')->where_in('iduser',$friend)->get()->num_rows();
	}
	public function fetch_notif($limit,$start,$where)
	{
		return $this->db->select('*')->from('notif')->where('iduser',$where)->where('status','0')->limit($limit,$start)->get()->result();
	}

	public function record_count_notif($where)
	{
		return $this->db->select('*')->from('notif')->where('iduser',$where)->where('status','0')->get()->num_rows();
	}
	public function explorebackend()
	{
		return $this->db->select("u.gambar as 'gambar',u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(p.id_post)','desc')->get()->result();
	}
	public function fetch_explore($limit,$start,$sort='',$by='')
	{
		//return $this->db->distinct()->select("u.iduser as 'iduser',u.email as 'email',count(p.id_post) as 'jml',count(c.id_post) as 'jmllike'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('comment c','p.id_post=c.id_post','left outer')->group_by('u.iduser')->order_by('count(p.id_post)','desc')->limit($limit,$start)->get()->result();
		if($sort=='')
		{
		return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(l.id_post)','desc')->limit($limit,$start)->get()->result();
		}
		else if($sort=='totalcomment')
		{
			return $this->db->distinct()->select("u.iduser as 'iduser',u.email as 'email',count(p.id_post) as 'jml',count(c.id_post) as 'jmlcom'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('comment c','p.id_post=c.id_post','left outer')->group_by('u.iduser')->order_by('count(c.id_post)',$by)->limit($limit,$start)->get()->result();
		}
		else if($sort=='username')
		{
			return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('email',$by)->limit($limit,$start)->get()->result();
		}
		else if($sort=='totallike')
		{
			return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(l.id_post)',$by)->limit($limit,$start)->get()->result();
		}
		else if($sort=='totalpost')
		{
			return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(p.id_post)',$by)->limit($limit,$start)->get()->result();
		}
		else if($sort=='search'){
			return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->like('u.email',$by)->group_by('u.iduser')->order_by('count(l.id_post)','desc')->limit($limit,$start)->get()->result();
		}
	}

	public function record_count_explore($sort='',$by='')
	{
		if($sort=='search')
		{
			return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(l.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->like('u.email',$by)->group_by('u.iduser')->order_by('count(l.id_post)','desc')->get()->num_rows();
		}
		else {
		return $this->db->select("u.iduser as 'iduser',u.email as 'email',count(p.id_post) as 'jml'")->from('user u')->join('post p','u.iduser=p.iduser','left outer')->join('like l','p.id_post=l.id_post','left outer')->group_by('u.iduser')->order_by('count(p.id_post)','desc')->get()->num_rows();
		}
	}

	public function loadshop($friend)
	{
		return $this->db->where_in('iduser',$friend)->get('shop')->result();
	}

	public function lihatbarang($where)
	{
		return $this->db->where('id_shop',$where)->get('shop')->result();
	}
	public function updateshop($where,$qty)
	{
		$this->db->where('id_shop',$where)->update('shop',array("qty"=>$qty));
	}
	public function updateverified($where,$verified)
	{
		$this->db->where('iduser',$where)->update('user',array("verified"=>$verified));
	}
}
