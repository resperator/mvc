<?php

class Controller_index extends Controller
{
	function __construct()
	{
		$this->model = new Model_Index();
		$this->view = new View();
	}
	

	 function action_index()
	{	
		$data = $this->model->get_data();
		$this->view->generate('', 'index_view.php', $data);
	}
	function action_signin()
	{	
		$_SESSION["login"] = $_POST['user'];
		$_SESSION["password"] = $_POST['password'];
		//
		if ($this->model->validate_user()==false) {$this->model->error_login=true;} 
		//
		$this->action_index();
	}
	function action_signout()
	{	
		$_SESSION["login"] = '';
		$_SESSION["password"] = '';
		//
		$this->action_index();
	}

	function action_to_page()
	{	
		$_SESSION["page"]=$_GET['id'];
		//
		$this->action_index();
	}

	function action_edit()
	{	
		$this->model->delta_task_id=$_POST['e_id'];
		$this->model->delta_task_name=$_POST['e_name'];
		$this->model->delta_task_mail=$_POST['e_mail'];
		$this->model->delta_task_text=$_POST['e_text'];
		//
		$this->action_index();
	}



	function action_change()
	{	
		$this->model->changing_task_id=$_GET['id'];
		//
		$this->action_index();
	}

	function action_chk_change()
	{	
		$this->model->delta_chk_id=$_GET['id'];
		$this->model->delta_chk_state=$_GET['state'];
		//
		$this->action_index();
	}

	//Функции сортировки
	function action_sort_date() //Сортировка по дате
	{	
	    if ($_SESSION["sort"]==1) {$_SESSION["sort_desc"] = !$_SESSION["sort_desc"];} else {$_SESSION["sort_desc"]=false;}
		$_SESSION["sort"] = 1;
		$this->action_index();
	}
	function action_sort_name() //Сортировка по имени
	{	
		if ($_SESSION["sort"]==2) {$_SESSION["sort_desc"] = !$_SESSION["sort_desc"];} else {$_SESSION["sort_desc"]=false;}
		$_SESSION["sort"] = 2;
		$this->action_index();
	}
	function action_sort_mail() //Сортировка по почте
	{	
		if ($_SESSION["sort"]==3) {$_SESSION["sort_desc"] = !$_SESSION["sort_desc"];} else {$_SESSION["sort_desc"]=false;}
		$_SESSION["sort"] = 3;
		$this->action_index();
	}
	function action_sort_chk() //Сортировка по выполнению
	{	
		if ($_SESSION["sort"]==4) {$_SESSION["sort_desc"] = !$_SESSION["sort_desc"];} else {$_SESSION["sort_desc"]=false;}
		$_SESSION["sort"] = 4;
		$this->action_index();
	}
}