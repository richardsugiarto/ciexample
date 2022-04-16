<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cont extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model','mdl');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->library('cart');
	}

	public function getfriend($friend,$iduser)
	{
		$stack=array();
		foreach ($friend as $key) {
      if($key->iduser1==$iduser)
      {
					array_push($stack,$key->iduser2);
      }
      else {
					array_push($stack,$key->iduser1);
      }
    }
		return $stack;
	}
	public function shoppage()
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
		$friend=$this->getfriend($this->mdl->getfriend($iduser[0]->iduser),$iduser[0]->iduser);
		$var['all_user']=$this->mdl->selectuser();
		$var['shop']=$this->mdl->loadshop($friend);
		$var['user']=$this->mdl->login($this->session->userdata('activeuser'));
		$this->load->view('shop',$var);
	}
	public function loadprivatechatroom($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$var["user"]=$this->mdl->login($data);
		$var["chat"]="";
		$var["id_chat"]="";
		$var["id_chatroom"]=$this->session->userdata('id_chatroom');
		$var["chat"]=$this->mdl->getallchat($this->session->userdata('id_chatroom'));
		$var["id_chat"]=$this->mdl->getallidchat($this->session->userdata('id_chatroom'));
		foreach ($var["id_chat"] as $key) {
			$this->mdl->updatereadchat($key->id_chat,$iduser[0]->iduser,$var["id_chatroom"]);
		}
		$var["isprivate"]=$this->mdl->getisprivatechat($var["id_chatroom"]);
		$this->load->view('chatroom',$var);
	}
}

	public function loadchatroom($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$index=$this->input->post('btnOpen');
		$var["user"]=$this->mdl->login($data);
		$var["chat"]="";
		$var["id_chat"]="";
		foreach($index as $key=>$value)
		{
			$this->session->set_userdata('id_chatroom',$key);
			$this->session->set_userdata('idchatroom',$key);
			$var["id_chatroom"]=$key;
			$var["chat"]=$this->mdl->getallchat($key);
			$var["id_chat"]=$this->mdl->getallidchat($key);
		}

		foreach ($var["id_chat"] as $key) {
			$this->mdl->updatereadchat($key->id_chat,$iduser[0]->iduser,$var["id_chatroom"]);
		}
		$var["isprivate"]=$this->mdl->getisprivatechat($var["id_chatroom"]);
		$this->load->view('chatroom',$var);
	}
	else {
		$this->load->view('login');
	}
	}

	public function loadallchat($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$var["user"]=$this->mdl->login($data);
		$var["id_chatroom"]=$this->session->userdata('idchatroom');
		$var["chat"]=$this->mdl->getallchat($this->session->userdata('idchatroom'));
		$var["id_chat"]=$this->mdl->getallidchat($this->session->userdata('idchatroom'));
		$var["isprivate"]=$this->mdl->getisprivatechat($this->session->userdata('idchatroom'));
		foreach ($var["id_chat"] as $key) {
			$this->mdl->updatereadchat($key->id_chat,$iduser[0]->iduser,$var["id_chatroom"]);
		}

		$this->load->view('chatroom',$var);
	}
		else {
			$this->load->view('login');
		}
	}

	public function chatpagination()
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/loadchatpage/".$this->session->userdata('activeuser');
		$config["total_rows"] = $this->mdl->record_count_chat($iduser[0]->iduser);
		$config["per_page"] = 6;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(4)) ? $this->uri->segment(4) : 0,$config["per_page"]);

	}

	public function loadchatpage($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));

		$page=$this->chatpagination();
		$var["id_chatroom"] = $this->mdl->fetch_chat($page[1],$page[0],$iduser[0]->iduser);
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;

		$var["user"]=$this->mdl->login($data);
		$this->session->set_userdata('idchatroom',$this->mdl->getidchatroom($iduser[0]->iduser));
		if($var["id_chatroom"]!=null)
		{
			$var["chatroom"]=$this->mdl->getallchatroom($iduser[0]->iduser);
		}

		$this->load->view('chat',$var);
		}
		else {
			$this->load->view('login');
		}
	}

	public function newsfeedpagination($friend)
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/loadnewsfeed/".$this->session->userdata('activeuser');
		$config["total_rows"] = $this->mdl->record_count_newsfeed($friend);
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(4)) ? $this->uri->segment(4) : 0,$config["per_page"]);
	}

	public function loadnewsfeed($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$friend=$this->getfriend($this->mdl->getfriend($iduser[0]->iduser),$iduser[0]->iduser);
		$page=$this->newsfeedpagination($friend);
		$var["post"] = $this->mdl->fetch_newsfeed($page[1],$page[0],$friend);
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;
		$var["all_friend"]=$this->mdl->showuser($friend);
		$var["like"]=$this->mdl->showlike();
		$var["comment"]=$this->mdl->showcomment();
		$var["user"]=$this->mdl->login($data);
		$var["all_user"]=$this->mdl->selectuser();
		$this->load->view('newsfeed',$var);
	}
		else {
			$this->load->view('login');
		}
	}

	public function profilepagination()
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/loadprofilepage/".$this->session->userdata('activeuser');
		$config["total_rows"] = $this->mdl->record_count_post($iduser[0]->iduser);
		$config["per_page"] = 7;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(4)) ? $this->uri->segment(4) : 0,$config["per_page"]);
	}

	public function loadprofilepage($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$page=$this->profilepagination();
		$var["post"] = $this->mdl->fetch_post($page[1],$page[0],$iduser[0]->iduser);
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;
		$var["like"]=$this->mdl->showlike();
		$var["comment"]=$this->mdl->showcomment();
		$var["user"]=$this->mdl->login($data);
		$var["skill"]=$this->mdl->getuserskill($iduser[0]->iduser);
		$var["endorse"]=$this->mdl->get3endorseskill($iduser[0]->iduser);
		$var["all_user"]=$this->mdl->selectuser();
		$this->load->view('profile',$var);
	}
	else {
		$this->load->view('login');
	}
	}
	public function explorepagination($sort='',$by='')
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/loadexplorepage/".$this->session->userdata('activeuser');

		$config["total_rows"] = $this->mdl->record_count_explore($this->session->userdata('sort'),$this->session->userdata('urut'));
		if($sort=="search")
		{
			$config["total_rows"] = $this->mdl->record_count_explore($sort,$by);
		}
		$config["per_page"] = 9;
		$sorting=$this->session->userdata('sort');
		$urut=$this->session->userdata('urut');
		if(($sorting=='username'&&$urut=='asc')||($sorting=='totalpost'&&$urut=='asc')||($sorting=='totallike'&&$urut=='asc'))
		{
			$config["per_page"] = 8;
		}
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(4)) ? $this->uri->segment(4) : 0,$config["per_page"]);
	}
	public function loadexplorepage($data,$sort='',$by='')
	{
		$this->load->library('session');
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		if($sort=='')
		{
		$page=$this->explorepagination();
		$var["listuser"]= $this->mdl->fetch_explore($page[1],$page[0],$this->session->userdata('sort'),$this->session->userdata('urut'));
	}
	else {
		$page=$this->explorepagination($sort,$by);
		$var["listuser"]= $this->mdl->fetch_explore($page[1],$page[0],$this->session->userdata('sort'),$this->session->userdata('urut'));
	}
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;
		$var["friend"]=$this->mdl->showfriend();
		$var["post"]=$this->mdl->showallpost();
		$var["like"]=$this->mdl->explorebackend();
		$var["user"]=$this->mdl->login($data);
		$this->load->view('explore',$var);
	}
	else {
		$this->load->view('login');
	}
	}

	public function mentionuserlainpage($data,$emailuserlain)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');

		$iduser=$this->mdl->getiduser($data);
		$iduserlain=$this->mdl->getiduser($emailuserlain);
		$id=$iduserlain[0]->iduser;
		$var["friend"]=$this->mdl->showfriend();
		$var["like"]=$this->mdl->showlike();
		$var["comment"]=$this->mdl->showcomment();
		$var["post"]=$this->mdl->showpost($id);
		$var["user"]=$this->mdl->login($data);
		$var["all_user"]=$this->mdl->selectuser();
		$var["userlain"]=$this->mdl->userlain($id);
		$var["skill"]=$this->mdl->getuserskill($var["userlain"][0]->iduser);
		$var["endorse"]=$this->mdl->get3endorseskill($var["userlain"][0]->iduser);
		$var["all_endorse"]=$this->mdl->getallendorsement();
		$this->session->set_userdata('otheruser',$var["userlain"][0]->iduser);
		$this->mdl->notiflihatprofile($id,$iduser[0]->iduser);
		$this->load->view('userlain',$var);
	}
	else {
		$this->load->view('login');
	}
	}
	public function userlainpagination($id)
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/userlainpage/".$this->session->userdata('activeuser')."/".$id;
		$config["total_rows"] = $this->mdl->record_count_post($id);
		$config["per_page"] = 7;
		$config["uri_segment"] = 5;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(5)) ? $this->uri->segment(5) : 0,$config["per_page"]);
	}
	public function userlainpage($data,$id)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
		$page=$this->userlainpagination($id);
		$var["post"] = $this->mdl->fetch_post($page[1],$page[0],$id);
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;
		$var["friend"]=$this->mdl->showfriend();
		$var["like"]=$this->mdl->showlike();
		$var["comment"]=$this->mdl->showcomment();
		$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
		$var["all_user"]=$this->mdl->selectuser();
		$var["userlain"]=$this->mdl->userlain($id);
		$var["skill"]=$this->mdl->getuserskill($var["userlain"][0]->iduser);
		$var["endorse"]=$this->mdl->get3endorseskill($var["userlain"][0]->iduser);
		$var["all_endorse"]=$this->mdl->getallendorsement();
		$this->session->set_userdata('otheruser',$var["userlain"][0]->iduser);
		$this->mdl->notiflihatprofile($id,$iduser[0]->iduser);
		$this->load->view('userlain',$var);
	}else {
		$this->load->view('login');
	}
	}

	public function notifpagination()
	{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
			//PAGINATION
		$config = array();
		$config["base_url"] = site_url()."/Cont/loadnotifpage/".$this->session->userdata('activeuser');
		$config["total_rows"] = $this->mdl->record_count_notif($iduser[0]->iduser);
		$config["per_page"] = 5;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<center><ul class='pagination'>";$config['full_tag_close'] = "</ul></center>";
		$config['first_tag_open'] = "<li>";$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";$config['last_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = "<li>";$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = '<li class="active"><a href="#">';$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return array(($this->uri->segment(4)) ? $this->uri->segment(4) : 0,$config["per_page"]);
	}
	public function loadnotifpage($data)
	{
		if($this->session->userdata('activeuser'))
		{
		$this->load->model('model','mdl');
		$iduser=$this->mdl->getiduser($data);
		$page=$this->notifpagination();
		$var["notif"] = $this->mdl->fetch_notif($page[1],$page[0],$iduser[0]->iduser);
		$var["links"] = $this->pagination->create_links();
		$var["halaman"] = $this->pagination->cur_page;
		$var["user"]=$this->mdl->login($data);
		$var["other"]=$this->mdl->selectuser();
		$this->load->view('notif',$var);
	}
	else {
		$this->load->view('login');
	}
	}
	public function index()
	{
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->library("form_validation");
			$temp2=$this->mdl->showfriend();
			$temp1=$this->mdl->selectuser();
			$temp0=$this->mdl->showcomment();
			$temp=$this->mdl->showallpost();
			$deletepost="";
			//accept
			foreach ($temp2 as $row) {
				if($this->input->post($row->idfriend))
				{
						if($this->input->post($row->idfriend)=="accept")
						{
							$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
							$this->mdl->updatefriend($row->idfriend,$row->iduser1,$row->iduser2,$iduser[0]->iduser);
							$deletepost=$row->idfriend;
							$this->loadnotifpage($this->session->userdata('activeuser'));
						}
						elseif($this->input->post($row->idfriend)=="reject")
						{
							$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
							$this->mdl->rejectfriend($row->idfriend,$row->iduser1,$row->iduser2,$iduser[0]->iduser);
							$deletepost=$row->idfriend;
							$this->loadnotifpage($this->session->userdata('activeuser'));
						}
						elseif($this->input->post($row->idfriend)=="UnFriend")
						{
							$this->mdl->deletefriend($row->idfriend);
							$deletepost=$row->idfriend;
							$this->loadexplorepage($this->session->userdata('activeuser'));
						}
						elseif($this->input->post($row->idfriend)==" UnFriend")
						{
							$this->mdl->deletefriend($row->idfriend);
							$deletepost=$row->idfriend;
							$this->userlainpage($this->session->userdata('activeuser'));
						}
				}
			}
			//add friend
			foreach ($temp1 as $key) {
					if($this->input->post($key->iduser))
					{
						if($this->input->post($key->iduser)=="AddFriend")
						{
							$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
							$this->mdl->addfriend($iduser[0]->iduser,$key->iduser);
							$deletepost=$key->iduser;
							$this->loadexplorepage($this->session->userdata('activeuser'));
						}
						elseif($this->input->post($key->iduser)==" AddFriend")
						{
							$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
							$this->mdl->addfriend($iduser[0]->iduser,$key->iduser);
							$deletepost=$key->iduser;
							$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
						}
					}
				}

			//untuk delete comment
			foreach ($temp0 as $key) {
				if($this->input->post($key->idcomment))
				{
					if($this->input->post($key->idcomment)=="X")
					{
						$temp=$this->mdl->deletecomment($key->idcomment);
						$deletepost=$key->idcomment;
						$this->loadprofilepage($this->session->userdata('activeuser'));
					}
					//other user
					elseif($this->input->post($key->idcomment)==" X")
					{
						$temp=$this->mdl->deletecomment($key->idcomment);
						$deletepost=$key->idcomment;
						$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
					}
				}
			}
			//untuk delete post dan like post dan insert comment
			if($deletepost==""){
			foreach ($temp as $val) {
				if($this->input->post($val->id_post))
				{
					if($this->input->post($val->id_post)=="X")
					{
						$temp=$this->mdl->deletepost($val->id_post);
						$deletepost=$val->id_post;
						$this->loadprofilepage($this->session->userdata('activeuser'));
					}
					else if($this->input->post($val->id_post)=="Like")
					{
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						$this->mdl->insertlike($val->id_post,$id[0]->iduser,$this->session->userdata('activeuser'),$val->iduser);
						$this->loadprofilepage($this->session->userdata('activeuser'));
					}
					elseif ($this->input->post($val->id_post)=="Unlike") {
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						$this->mdl->unlike($val->id_post,$id[0]->iduser);
						$this->loadprofilepage($this->session->userdata('activeuser'));
					}
					elseif ($this->input->post($val->id_post)=="Comment") {
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						//upload
						$config['upload_path'] ="./uploads/";
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']='0';
						$config['max_width']='0';
						$config['max_height']='0';
						$config['encrypt_name']=TRUE;
						$config['overwrite']=TRUE;
						$this->load->library('upload');
						$this->upload->initialize($config);
							if(!$this->upload->do_upload("gambar"))
							{
								$this->session->set_flashdata('message',$this->upload->display_errors());
							}
							else {
								$te=$this->upload->data();
								$this->session->set_flashdata('message',"Berhasil Upload");
								$this->mdl->insertcomment($val->id_post,$this->input->post($val->id_post."1"),$id[0]->iduser,$this->session->userdata('activeuser'),$val->iduser,$te['file_name']);
							}
						$this->loadprofilepage($this->session->userdata('activeuser'));
					}
					//other user
					elseif($this->input->post($val->id_post)==" Comment")
					{
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						//upload
						$config['upload_path'] ="./uploads/";
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']='0';
						$config['max_width']='0';
						$config['max_height']='0';
						$config['encrypt_name']=TRUE;
						$config['overwrite']=TRUE;
						$this->load->library('upload');
						$this->upload->initialize($config);
							if(!$this->upload->do_upload("gambar"))
							{
								$this->session->set_flashdata('message',$this->upload->display_errors());
							}
							else {
								$te=$this->upload->data();
								$this->session->set_flashdata('message',"Berhasil Upload");
								$this->mdl->insertcomment($val->id_post,$this->input->post($val->id_post."1"),$id[0]->iduser,$this->session->userdata('activeuser'),$val->iduser,$te['file_name']);
							}
						$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
					}
					else if($this->input->post($val->id_post)==" Like")
					{
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						$this->mdl->insertlike($val->id_post,$id[0]->iduser,$this->session->userdata('activeuser'),$val->iduser);
						$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
					}
					elseif ($this->input->post($val->id_post)==" Unlike") {
						$deletepost=$val->id_post;
						$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
						$this->mdl->unlike($val->id_post,$id[0]->iduser);
						$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
					}
				}
			}
			}
			if($this->input->post('btnRegister'))
			{
					$this->load->view('regis1');
			}
			else if($this->input->post('btnNext'))
			{
				$this->form_validation->set_rules("namad","Nama Depan","required|alpha");
				$this->form_validation->set_rules("namab","Nama Belakang","alpha");
				$this->form_validation->set_rules("email","E-mail","required|valid_email");
				$this->form_validation->set_rules("hp","Hp","required|numeric");
				$this->form_validation->set_rules("pass","Password","required|min_length[6]|callback_pass_check");
				$this->form_validation->set_rules("confirmpass","Confirm Password","required|matches[pass]");
				if($this->form_validation->run()==TRUE){

					$this->load->model('model','mdl');
					$this->mdl->insert_user1($this->input->post('namad'),$this->input->post('namab'),$this->input->post('email'),$this->input->post('hp'),$this->input->post('pass'));
					$this->load->view('regis2');
				}
				else {
					$this->session->set_flashdata('namad_error',form_error("namad"));
					$this->session->set_flashdata('namab_error',form_error("namab"));
					$this->session->set_flashdata('email_error',form_error("email"));
					$this->session->set_flashdata('hp_error',form_error("hp"));
					$this->session->set_flashdata('pass_error',form_error("pass"));
					$this->session->set_flashdata('confirmpass_error',form_error("confirmpass"));
	        $this->load->view("regis1");
				}
			}
			else if($this->input->post('btnRegister_regis'))
			{
				$this->form_validation->set_rules("alamat","Alamat","required");
				$this->form_validation->set_rules("kodepos","Kode pos","numeric");
				$this->form_validation->set_rules("negara","Negara","required");
				$this->form_validation->set_rules("jabatan","Jabatan","required");
				$this->form_validation->set_rules("perusahaan","Perusahaan","required");
				if($this->form_validation->run()==TRUE){
					$this->load->model('model','mdl');
					$private=0;
					if($this->input->post('privacy')=="private")
					{
						$private=1;
					}
					$this->mdl->insert_user2($this->input->post('alamat'),$this->input->post('kodepos'),$this->input->post('negara'),$this->input->post('jabatan'),$this->input->post('perusahaan'),$this->input->post('bioperusahaan'),$this->input->post('biouser'),$private);
					$this->load->view('login');
				}
				else {
					$this->session->set_flashdata('alamat_error',form_error("alamat"));
					$this->session->set_flashdata('kodepos_error',form_error("kodepos"));
					$this->session->set_flashdata('negara_error',form_error("negara"));
					$this->session->set_flashdata('jabatan_error',form_error("jabatan"));
					$this->session->set_flashdata('perusahaan_error',form_error("perusahaan"));
	        $this->load->view("regis2",$var);
				}
			}
			else if($this->input->post('btnLogin'))
			{
				$this->form_validation->set_rules('username','Username','required|callback_emailcheck');
				$this->form_validation->set_rules('password','Password','required|callback_passlogincheck');
				if($this->form_validation->run()==TRUE){
					$user=$this->mdl->login($this->input->post('username'));
					$this->session->set_userdata('activeuser',$user[0]->email);
					$this->loadprofilepage($this->input->post('username'));
				}
				else {
					$this->session->set_flashdata('username_error',form_error("username"));
					$this->session->set_flashdata('password_error',form_error("password"));
					$this->load->view('login');
				}
			}
			else if($this->input->post('btnpost'))
			{
				$data['conf']="";
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$config['upload_path'] ="./uploads/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']='0';
				$config['max_width']='0';
				$config['max_height']='0';
				$config['encrypt_name']=TRUE;
				$config['overwrite']=TRUE;
				$this->load->library('upload');
				$this->upload->initialize($config);
					if(!$this->upload->do_upload("gambar"))
					{
						$data['error']=$this->upload->display_errors();
					}
					else {
						$te=$this->upload->data();
						$data['conf']="Berhasil Upload";
						$this->mdl->newpost($this->input->post('post'),$iduser[0]->iduser,$te["file_name"]);
					}
					$this->loadprofilepage($this->session->userdata('activeuser'));
			}
			else if ($this->input->post('btnEditprofile')) {
				$this->mdl->seteditaccount($this->session->userdata('activeuser'));
				$var["activeuser"]=$this->session->userdata('activeuser');
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$this->load->view("editprofile",$var);
			}
			else if($this->input->post('btnBackProfile'))
			{
				$this->mdl->unseteditaccount($this->session->userdata('activeuser'));
				$this->loadprofilepage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnEditedprofile'))
			{
				$this->form_validation->set_rules("alamat","Alamat","required");
				$this->form_validation->set_rules("kodepos","Kode pos","numeric");
				$this->form_validation->set_rules("negara","Negara","required");
				$this->form_validation->set_rules("jabatan","Jabatan","required");
				$this->form_validation->set_rules("perusahaan","Perusahaan","required");
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				if($this->form_validation->run()==TRUE){
						$private=0;
						if($this->input->post('privacy')=="private")
						{
							$private=1;
						}
						$music="";
						//upload file music
						$config['upload_path'] ="./uploads/";
						$config['allowed_types'] = 'mp3|wav';
						$config['max_size']='0';
						$config['max_width']='0';
						$config['max_height']='0';
						$config['encrypt_name']=TRUE;
						$config['overwrite']=TRUE;
						$this->load->library('upload');
						$this->upload->initialize($config);
							if(!$this->upload->do_upload("music"))
							{
								$data['error']=$this->upload->display_errors();
							}
							else {
								$te=$this->upload->data();
								$data['conf']="Berhasil Upload";
								$music=$te['file_name'];
							}
							//uploadfilegambar
							$config['upload_path'] ="./uploads/";
							$config['allowed_types'] = 'jpg|gif|jpeg|png';
							$config['max_size']='0';
							$config['max_width']='0';
							$config['max_height']='0';
							$config['encrypt_name']=TRUE;
							$config['overwrite']=TRUE;
							$this->load->library('upload');
							$this->upload->initialize($config);
								if(!$this->upload->do_upload("gambar"))
								{
									$data['error']=$this->upload->display_errors();
								}
								else {
									$te=$this->upload->data();
									$data['conf']="Berhasil Upload";
									$this->mdl->insert_user2($this->input->post('alamat'),$this->input->post('kodepos'),$this->input->post('negara'),$this->input->post('jabatan'),$this->input->post('perusahaan'),$this->input->post('bioperusahaan'),$this->input->post('biouser'),$private,$music,$te['file_name']);
								}
						$this->loadprofilepage($this->session->userdata('activeuser'));
				}
				else {
					$var["activeuser"]=$this->session->userdata('activeuser');
					$var["alamat_error"] = form_error("alamat");
					$var["kodepos_error"] = form_error("kodepos");
					$var["negara_error"] = form_error("negara");
					$var["jabatan_error"] = form_error("jabatan");
					$var["perusahaan_error"] = form_error("perusahaan");
					$this->load->view("editprofile",$var);
				}
			}
			else if($this->input->post('btnEditaccount'))
			{
				$this->mdl->seteditaccount($this->session->userdata('activeuser'));
				$var["activeuser"]=$this->session->userdata('activeuser');
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$this->load->view("editaccount",$var);
			}
			else if($this->input->post('btnEditedaccount'))
			{
				$this->form_validation->set_rules("namad","Nama Depan","required|alpha");
				$this->form_validation->set_rules("namab","Nama Belakang","alpha");
				$this->form_validation->set_rules("email","E-mail","required|valid_email");
				$this->form_validation->set_rules("hp","Hp","required|numeric");
				$this->form_validation->set_rules("pass","Password","required|min_length[6]|callback_pass_check");
				$this->form_validation->set_rules("confirmpass","Confirm Password","required|matches[pass]");
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				if($this->form_validation->run()==TRUE){
					$id=$this->mdl->getiduser($this->session->userdata('activeuser'));
					$this->mdl->update_user1($this->input->post('namad'),$this->input->post('namab'),$this->input->post('email'),$this->input->post('hp'),$this->input->post('pass'),$id);
					$this->mdl->unseteditaccount($this->input->post('email'));
					$this->loadprofilepage($this->input->post('email'));
				}
				else {
					$var["activeuser"]=$this->session->userdata('activeuser');
					$var["namad_error"] = form_error("namad");
					$var["namab_error"] = form_error("namab");
					$var["email_error"] = form_error("email");
					$var["hp_error"] = form_error("hp");
					$var["pass_error"] = form_error("pass");
					$var["confirmpass_error"] = form_error("confirmpass");
	        $this->load->view("editaccount",$var);
				}
			}
			else if($this->input->post('btnBackAccount'))
			{
				$this->mdl->unseteditaccount($this->session->userdata('activeuser'));
				$this->loadprofilepage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnLogout'))
			{
				$this->session->sess_destroy();
				$this->session->set_flashdata('logout','Anda Telah Log Out');
				$this->load->view("login");
			}
			else if($this->input->post('DELETE'))
			{
				$this->load->view('login',$var);
				echo $this->input->post('DELETE');
			}
			else if($this->input->post('btnOpen'))
			{
				$this->loadchatroom($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnNewChat'))
			{
				$this->load->model('model','mdl');
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$page=$this->chatpagination();
				$var["id_chatroom"] = $this->mdl->fetch_chat($page[1],$page[0],$iduser[0]->iduser);
				$var["links"] = $this->pagination->create_links();
				$var["halaman"] = $this->pagination->cur_page;
				$var["friend"]=$this->mdl->getfriend($iduser[0]->iduser);
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				if($var["id_chatroom"]!=null)
				{
					$var["chatroom"]=$this->mdl->getallchatroom($iduser[0]->iduser);
				}
				$this->load->view('chat',$var);
			}
			else if($this->input->post('btnNewPrivateChat')){
				$this->load->model('model','mdl');
				$this->session->set_userdata('privatechat','1');
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$page=$this->chatpagination();
				$var["id_chatroom"] = $this->mdl->fetch_chat($page[1],$page[0],$iduser[0]->iduser);
				$var["links"] = $this->pagination->create_links();
				$var["halaman"] = $this->pagination->cur_page;
				$var["friend"]=$this->mdl->getfriend($iduser[0]->iduser);
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				if($var["id_chatroom"]!=null)
				{
					$var["chatroom"]=$this->mdl->getallchatroom($iduser[0]->iduser);
				}
				$this->load->view('chat',$var);
			}
			else if($this->input->post('btnChat'))
			{
				$index=$this->input->post('btnChat');
				$id="";
				foreach($index as $key=>$value)
				{
					$id=$key;
				}
				$this->load->model('model','mdl');
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				if($this->session->userdata('privatechat')==null)
				{
					$this->mdl->newchatroom($iduser[0]->iduser,$id,'0');
				}
				else {
					$this->mdl->newchatroom($iduser[0]->iduser,$id,'1');
					$this->session->unset_userdata('privatechat');
				}
				$page=$this->chatpagination();
				$var["id_chatroom"] = $this->mdl->fetch_chat($page[1],$page[0],$iduser[0]->iduser);
				$var["links"] = $this->pagination->create_links();
				$var["halaman"] = $this->pagination->cur_page;
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$var["chatroom"]=$this->mdl->getallchatroom($iduser[0]->iduser);
				$this->load->view('chat',$var);
			}
			else if($this->input->post('btnDeleteChat'))
			{
				$index=$this->input->post('btnDeleteChat');
				$id="";
				foreach($index as $key=>$value)
				{
					$id=$key;
				}
				$this->load->model('model','mdl');
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$this->mdl->deletemessagechat($iduser[0]->iduser,$id);
				$this->load->model('model','mdl');
				$index=$this->session->userdata('idchatroom');
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$var["chat"]="";
				$var["chat"]=$this->mdl->getallchat($index);
				$var["id_chat"]=$this->mdl->getallidchat($index);
				$this->load->view('chatroom',$var);
			}
			else if($this->input->post('btnSend'))
			{
				$index=$this->input->post('btnSend');
				$id="";
				foreach($index as $key=>$value)
				{
					$id=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$config['upload_path'] ="./uploads/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']='0';
				$config['max_width']='0';
				$config['max_height']='0';
				$config['encrypt_name']=TRUE;
				$config['overwrite']=TRUE;
				$this->load->library('upload');
				$this->upload->initialize($config);
					if(!$this->upload->do_upload("gambar"))
					{
						$data['error']=$this->upload->display_errors();
					}
					else {
						$te=$this->upload->data();
						$data['conf']="Berhasil Upload";
						$this->mdl->insertchat($id,$this->input->post('chat'),$iduser[0]->iduser,$te['file_name']);
					}
				$this->loadallchat($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnInviteChat'))
			{
				$this->load->model('model','mdl');
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$var["friend"]=$this->mdl->getfriend($iduser[0]->iduser);
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$var["id_chatroom"]=$this->session->userdata('idchatroom');
				$var["chat"]=$this->mdl->getallchat($this->session->userdata('idchatroom'));
				$var["id_chat"]=$this->mdl->getallidchat($this->session->userdata('idchatroom'));
				$var["isprivate"]=$this->mdl->getisprivatechat($this->session->userdata('idchatroom'));
				foreach ($var["id_chat"] as $key) {
					$this->mdl->updatereadchat($key->id_chat,$iduser[0]->iduser,$var["id_chatroom"]);
				}
				$this->load->view('chatroom',$var);
			}
			else if($this->input->post('btnInvite'))
			{
				$index=$this->input->post('btnInvite');
				$id="";
				foreach($index as $key=>$value)
				{
					$id=$key;
				}
				$this->mdl->InviteChat($id,$this->session->userdata('idchatroom'));
				$this->loadallchat($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnEndChat'))
			{
				$index=$this->input->post('btnEndChat');
				$idchatroom="";
				foreach($index as $key=>$value)
				{
					$idchatroom=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$this->mdl->endchat($idchatroom,$iduser[0]->iduser);
				$this->loadchatpage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnseeallskill'))
			{
					$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
					$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
					$var["skill"]=$this->mdl->getuserskill($iduser[0]->iduser);
					$var["endorse"]=$this->mdl->getallendorsement();
					$var["jenis"]=$this->mdl->getalljenisskill();
					$this->load->view('skill',$var);
			}
			else if($this->input->post('btnInsertSkill'))
			{
					$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
					$jmlskill=$this->mdl->getjumlahskill($iduser[0]->iduser);
					if($jmlskill[0]->jumlah<5)
					{
						if($this->input->post('txtskill')!="")
						{
								$this->mdl->newinsertskill($this->input->post('txtskill'),$iduser[0]->iduser);
						}
						else {
								$this->mdl->insertskill($this->input->post('combojenis'),$iduser[0]->iduser);
						}
					}
					else {
						$var["error"]="ERROR Jumlah skill sudah 5!!!!";
					}
					$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
					$var["skill"]=$this->mdl->getuserskill($iduser[0]->iduser);
					$var["endorse"]=$this->mdl->getallendorsement();
					$var["jenis"]=$this->mdl->getalljenisskill();
					$this->load->view('skill',$var);
			}
			else if($this->input->post('btnDeleteSkill'))
			{
				$index=$this->input->post('btnDeleteSkill');
				$idjenis="";
				foreach($index as $key=>$value)
				{
					$idjenis=$key;
				}
				$this->mdl->deleteskill($idjenis);
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$var["skill"]=$this->mdl->getuserskill($iduser[0]->iduser);
				$var["endorse"]=$this->mdl->getallendorsement();
				$var["jenis"]=$this->mdl->getalljenisskill();
				$this->load->view('skill',$var);
			}
			else if($this->input->post('btnEndorsed'))
			{
				$index=$this->input->post('btnEndorsed');
				$idskill="";
				foreach($index as $key=>$value)
				{
					$idskill=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$this->mdl->endorse($iduser[0]->iduser,$idskill);
				$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
			}
			else if($this->input->post('btnUnendorsed'))
			{
				$index=$this->input->post('btnUnendorsed');
				$idskill="";
				foreach($index as $key=>$value)
				{
					$idskill=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$this->mdl->unendorse($iduser[0]->iduser,$idskill);
				$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
			}
			else if($this->input->post('btnSendMessage'))
			{
				$index=$this->input->post('btnSendMessage');
				$iduserlain="";
				foreach($index as $key=>$value)
				{
					$iduserlain=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$idchatroom=0;
				$all_chatroom=$this->mdl->allchatroom();

				foreach ($all_chatroom as $key) {
						$chatmember=$this->mdl->getChatMember($key->id_chatroom);
						$jumlahmember=0;
						$user=0;
						foreach ($chatmember as $val) {
								if($val->iduser==$iduserlain||$val->iduser==$iduser[0]->iduser)
								{
									$user+=1;
								}
								$jumlahmember+=1;
						}
						if($user==$jumlahmember)
						{
							$idchatroom=$key->id_chatroom;
							break;
						}
				}
				if($idchatroom==0)
				{
					$this->mdl->newchatroom($iduser[0]->iduser,$iduserlain,'0');
					$this->userlainpage($this->session->userdata('activeuser'),$this->session->userdata('otheruser'));
				}
				else {
					$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
					$var["chat"]=$this->mdl->getallchat($idchatroom);
					$var["id_chat"]=$this->mdl->getallidchat($idchatroom);
					$var["id_chatroom"]=$idchatroom;
					foreach ($var["id_chat"] as $key) {
						$this->mdl->updatereadchat($key->id_chat,$iduser[0]->iduser,$var["id_chatroom"]);
					}
					$this->load->view('chatroom',$var);
				}
			}
			else if($this->input->post('btnShared'))
			{
				$index=$this->input->post('btnShared');
				$idpost="";
				foreach($index as $key=>$value)
				{
					$idpost=$key;
				}
				$post=$this->mdl->getspecificpost($idpost);
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$user=$this->mdl->getuser($iduser[0]->iduser);
				$isi=$post[0]->isi." "."Shared from @".$user[0]->email;
				$this->mdl->newpost($isi,$iduser[0]->iduser);
				$this->loadnewsfeed($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnLihat'))
			{
				$index=$this->input->post('btnLihat');
				$iduserlain="";
				foreach($index as $key=>$value)
				{
					$iduserlain=$key;
				}
				$isfriend=0;
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$listfriend=$this->getfriend($this->mdl->getfriend($iduser[0]->iduser),$iduser[0]->iduser);
				for ($i=0; $i < count($listfriend); $i++) {
					if($listfriend[$i]==$iduserlain)
					{
							$isfriend=1;
					}
				}
				$userlain=$this->mdl->getuser($iduserlain);
				if($userlain[0]->isprivate==0)
				{
					$this->load->helper('form');
					$this->userlainpage($this->session->userdata('activeuser'),$iduserlain);
				}
				else if($userlain[0]->isprivate==1&&$isfriend==0){
					$var["friend"]=$this->mdl->showfriend();
					$var["listuser"]=$this->mdl->explore();
					$var["post"]=$this->mdl->showallpost();
					$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
					$var["error"]="User ini private";
					$this->load->view('explore',$var);
				}
			}
			else if($this->input->post('btntimepost'))
			{
				$this->load->helper('cookie');
					$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
					date_default_timezone_set('Asia/Jakarta');
					$cookie=array('name'=>rand(),'value'=>"post*".$iduser[0]->iduser."*".$this->input->post('post')."*".date('G')."*".date('i')."*".date('s'),'expire'=>120);
					$this->input->set_cookie($cookie);
					$this->loadprofilepage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnSendprivate')){
				$index=$this->input->post('btnSendprivate');
				$idchatroom="";
				foreach($index as $key=>$value)
				{
					$idchatroom=$key;
				}
				$iduser=$this->mdl->getiduser($this->session->userdata('activeuser'));
				$user=$this->mdl->getuser($iduser[0]->iduser);
					$cookie=array('name'=>rand(),'value'=>"chat*".$idchatroom."*".$iduser[0]->iduser."*".$this->input->post('chatprivate')."*".$user[0]->namad,'expire'=>30);
					$this->input->set_cookie($cookie);
					$this->loadprivatechatroom($this->session->userdata('activeuser'));
			}
			else if($this->input->post('sorting')){
				$this->session->set_userdata('sort',$this->input->post('sort'));
				$this->session->set_userdata('urut',$this->input->post('urut'));
				$this->loadexplorepage($this->session->userdata('activeuser'),$this->input->post('sort'),$this->input->post('urut'));
			}
			else if($this->input->post('reset'))
			{
				$this->session->unset_userdata('sort');
				$this->session->unset_userdata('urut');
				$this->loadexplorepage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnsearch'))
			{
				$this->session->set_userdata('sort','search');
				$this->session->set_userdata('urut',$this->input->post('textsearch'));
				$this->loadexplorepage($this->session->userdata('activeuser'));
			}
			else if($this->input->post('btnCheckOut'))
			{
				if($this->cart->contents()!=null)
				{
					$var['user']=$this->mdl->login($this->session->userdata('activeuser'));
					$this->load->view('checkout',$var);
				}
				else {
					$this->shop();
				}
			}
			else if($this->input->post('btnLihatBrg'))
			{
				$idshop="";
				foreach ($this->input->post('btnLihatBrg') as $key => $value) {
					$idshop=$key;
				}
				$this->load->model('model','mdl');
				$var['shop']=$this->mdl->lihatbarang($idshop);
				$var['user']=$this->mdl->login($this->session->userdata('activeuser'));
				$var['all_user']=$this->mdl->selectuser();
				$this->load->view('barang',$var);
			}
			else if($this->input->post('addToCart'))
			{
				$idshop="";
				$qty=0;
				foreach ($this->input->post('addToCart') as $key => $value) {
					$idshop=$key;
				}
				$data=array();
				$this->load->model('model','mdl');
				$shop=$this->mdl->lihatbarang($idshop);
				foreach ($shop as $key) {
					$data=array(
						'id'=>$key->id_shop,
						'qty'=>'1',
						'price'=>$key->price,
						'name'=>$key->nama
					);
					$qty=$key->qty;
				}
				$qtycart=0;
				if($this->cart->contents())
				{
						foreach ($this->cart->contents() as $key) {
							if($key['id']==$idshop)
							{
									$qtycart=$key['qty'];
							}
						}
				}
				if($qty-($qtycart+1)>=0)
				{
					$this->cart->insert($data);
				}
				else {
					$this->session->set_flashdata('errorbuy','Stok tidak mencukupi');
				}
				$this->shop();
			}
			else if($this->input->post('btnCancelCart'))
			{
				$rowid="";
				foreach ($this->input->post('btnCancelCart') as $key => $value) {
					$rowid=$key;
				}
				$data=array(
					'rowid'=>$rowid,
					'qty'=>0
				);
				$this->cart->update($data);
				$var['user']=$this->mdl->login($this->session->userdata('activeuser'));
				$this->load->view('checkout',$var);
			}
			else if($this->input->post('btnUbahQty'))
			{
				$rowid="";
				$idshop="";
				$qty=0;
				foreach ($this->input->post('btnUbahQty') as $key => $value) {
					$rowid=$key;
				}
				foreach ($this->cart->contents() as $key) {
					if($key['rowid']==$rowid)
					{
							$idshop=$key['id'];
					}
				}
				$shop=$this->mdl->lihatbarang($idshop);
				foreach ($shop as $key) {
					$qty=$key->qty;
				}
				$data=array(
					'rowid'=>$rowid,
					'qty'=>$this->input->post($rowid)
				);
				if($qty-$this->input->post($rowid)>=0)
				{
					$this->cart->update($data);
				}
				else {
					$this->session->set_flashdata('errorstok','Stok barang tidak mencukupi');
				}
				$var['user']=$this->mdl->login($this->session->userdata('activeuser'));
				$this->load->view('checkout',$var);
			}
			else if($this->input->post('btnCheckOutAll'))
			{
				foreach ($this->cart->contents() as $key) {
					$shop=$this->mdl->lihatbarang($key['id']);
					$qty=0;
					$user="";
					foreach ($shop as $val) {
						$qty=$val->qty-$key['qty'];
						$user=$val->iduser;
					}
					$this->mdl->updateverified($user,'1');
					$this->mdl->updateshop($key['id'],$qty);
				}
				$this->session->set_flashdata('successbuy','You Have Purchased Successfully');
				$this->cart->destroy();
				$this->shop();
			}
			else if($deletepost==""){
				$this->load->view('login');
			}

	}
//bagian link href

	public function shop()
	{
		if($this->session->userdata('activeuser')!=null)
		{
			$this->shoppage();
		}
		else {
			$this->load->view('login');
		}
	}
	public function ajaxendorse()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->model('model','mdl');
		$var["endorsed"]=$this->mdl->endorseajax($this->input->post('id'));
		$this->load->view('ajaxendorse',$var);
		}
		else {
			$this->load->view('login');
		}
	}
	public function ajaxlike()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->model('model','mdl');
		$var["liked"]=$this->mdl->likeajax($this->input->post('id'));
		$this->load->view('ajaxlike',$var);
	}
	else {
			$this->load->view('login');
	}
	}
	public function mentionuserlain()
	{
		if($this->session->userdata('activeuser')!=null)
		{
			$iduserlain=$this->mdl->getiduser($_GET['emailuserlain']);
		$this->load->model('model','mdl');
		$isfriend=0;
		$iduser=$this->mdl->getiduser($_GET['activeuser']);
		$listfriend=$this->getfriend($this->mdl->getfriend($iduser[0]->iduser),$iduser[0]->iduser);
		for ($i=0; $i < count($listfriend); $i++) {
			if($listfriend[$i]==$iduserlain[0]->iduser)
			{
					$isfriend=1;
			}
		}
		$userlain=$this->mdl->getuser($iduserlain[0]->iduser);
		if($userlain[0]->isprivate==0)
		{
			$this->load->helper('form');
			$this->mentionuserlainpage($_GET['activeuser'],$_GET['emailuserlain']);
		}
		else if($userlain[0]->isprivate==1&&$isfriend==0){
			$var["friend"]=$this->mdl->showfriend();
			$var["listuser"]=$this->mdl->explore();
			$var["post"]=$this->mdl->showallpost();
			$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
			$var["error"]="User ini private";
			$this->load->view('explore',$var);
		}
	}
	else {
		$this->load->view('login');
	}
	}
	public function newsfeed()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->helper('form');
		$this->loadnewsfeed($_GET['activeuser']);
	}
	else {
		$this->load->view('login');
	}
	}
	public function chat()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->helper('form');
		$this->loadchatpage($_GET['activeuser']);
	}
	else {
		$this->load->view('login');
	}
	}
	public function profile()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->helper('form');
		$this->loadprofilepage($_GET['activeuser']);
		}
		else {
			$this->load->view('login');
		}
	}
	public function explore()
	{
		if($this->session->userdata('activeuser')!=null)
		{
		$this->load->helper('form');
		$this->loadexplorepage($_GET['activeuser']);
		}
		else {
			$this->load->view('login');
		}
	}
	public function profiluserlain()
	{
		if($this->session->userdata('activeuser')!=null)
		{
			$this->load->model('model','mdl');
			$isfriend=0;
			$iduser=$this->mdl->getiduser($_GET['activeuser']);
			$listfriend=$this->getfriend($this->mdl->getfriend($iduser[0]->iduser),$iduser[0]->iduser);
			for ($i=0; $i < count($listfriend); $i++) {
				if($listfriend[$i]==$_GET['userlain'])
				{
						$isfriend=1;
				}
			}
			$userlain=$this->mdl->getuser($_GET['userlain']);
			if($userlain[0]->isprivate==0||($userlain[0]->isprivate==1&&$isfriend==1))
			{
				$this->load->helper('form');
				$this->userlainpage($_GET['activeuser'],$_GET['userlain']);
			}
			else if($userlain[0]->isprivate==1&&$isfriend==0){
				$var["friend"]=$this->mdl->showfriend();
				$var["listuser"]=$this->mdl->explore();
				$var["post"]=$this->mdl->showallpost();
				$var["user"]=$this->mdl->login($this->session->userdata('activeuser'));
				$var["error"]="User ini private";
				$this->load->view('explore',$var);
			}
		}
		else {
			$this->load->view('login');
		}
	}
	public function notif()
	{
		if($this->session->userdata('activeuser')!=null)
		{
			$this->load->helper('form');
			$this->loadnotifpage($_GET['activeuser']);
		}
		else {
			$this->load->view('login');
		}
	}
	public function ajaxupload()
	{
		if($this->session->userdata('activeuser')!=null)
		{
			echo form_upload(array('class'=>'btn btn-default','name'=>'gambar'));
		}
		else {
			$this->load->view('login');
		}
	}
//form validation
	public function emailcheck($str)
	{
		$this->load->model('model','mdl');
		$data=$this->mdl->selectuser();
		foreach ($data as $row) {
			if($row->email==$this->input->post('username'))
			{
				return TRUE;
			}
			else if ($row->hp==$this->input->post('username')) {
				return TRUE;
			}
		}
		if($this->input->post('username')!="")
		{
			$this->form_validation->set_message('emailcheck','Email/No.Hp tidak terdaftar');
		}
		else {
			$this->form_validation->set_message('emailcheck','The Username field is required.');
		}
		return FALSE;

	}

	public function passlogincheck($str)
	{
		$this->load->model('model','mdl');
		$data=$this->mdl->selectuser();
		foreach ($data as $row) {
			if($row->password==$this->input->post('password'))
			{
				return TRUE;
			}
		}
		if($this->input->post('password')!="")
		{
			$this->form_validation->set_message('passlogincheck','Password salah');
		}
		else {
			$this->form_validation->set_message('passlogincheck','The Password field is required.');
		}
		return FALSE;
	}

	public function pass_check($str)
	{
		$flag_kapital=0;
		$flag_kecil=0;
		$flag_simbol=0;
		$flag_angka=0;
		for ($i=65; $i <=90 ; $i++) {
			for ($j=0; $j < strlen($str); $j++) {
					if(chr($i)==$str[$j])
					{
						$flag_kapital=1;
						break;
					}
			}
		}
		for ($i=97; $i <=122 ; $i++) {
			for ($j=0; $j < strlen($str); $j++) {
					if(chr($i)==$str[$j])
					{
						$flag_kecil=1;
						break;
					}
			}
		}
		for ($i=48; $i <=57 ; $i++) {
			for ($j=0; $j < strlen($str); $j++) {
					if(chr($i)==$str[$j])
					{
						$flag_angka=1;
						break;
					}
			}
		}
		for ($i=0; $i <=126 ; $i++) {
			if(($i>=33 && $i<=47)||($i>=58&&$i<=64)||($i>=91&&$i<=96)||($i>=123&&$i<=126))
			{
				for ($j=0; $j < strlen($str); $j++) {
						if(chr($i)==$str[$j])
						{
							$flag_simbol=1;
							break;
						}
				}
			}
		}
		if($flag_simbol==1&&$flag_kecil==1&&$flag_angka==1&&$flag_kapital==1)
		{
			return true;
		}
		else {
			if($this->input->post('pass')!="")
			{
				$this->form_validation->set_message('pass_check','Password harus terdapat huruf kecil,huruf kapital,angka,dan simbol');
			}
			else {
				$this->form_validation->set_message('pass_check','The Password field is required.');
			}
			return false;
		}
	}

}
