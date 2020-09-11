<?php

class Model_Index extends Model
{
	//Тип сортировки
	private $sort = 1;
	private $sort_descending=false;
	//Переменные изменения галочки выполнения задания
	public $delta_chk_id = 0;
	public $delta_chk_state = 0;
	//Переменные изменения других параметров задания
	public $delta_task_id = -1;
	public $delta_task_name='';
	public $delta_task_mail='';
	public $delta_task_text='';
	//Переменная, которая хранит id задания, которое хочет изменить пользователь
	public $changing_task_id=-1;
	//Перемнные пагинации
	public $page_items_per_page=3;
	public $page_items_count;
	public $page_count;
	public $page_index=1;

	public $error_login=false;



	public function validate_change_chk_data()
	{
		return is_numeric($this->delta_chk_id) and (is_numeric($this->delta_chk_state));
	}

	public function validate_change_task_data()
	{
		if (!is_numeric($this->delta_task_id)) return false; //Проверим id
		$this->delta_task_name = (strip_tags ($this->delta_task_name));
		if ((strlen($this->delta_task_name)<1) or (strlen($this->delta_task_name)>255))  return false; //Проверим name
		if ((strlen($this->delta_task_mail)<1) or (strlen($this->delta_task_mail)>255))  return false; //Проверим email
		if (!filter_var($this->delta_task_mail, FILTER_VALIDATE_EMAIL)) return false; //email
		$this->delta_task_text = (strip_tags ($this->delta_task_text, '<b>'));
		if ((strlen($this->delta_task_text)<1) or (strlen($this->delta_task_text)>255))  return false; //Проверим text		
		return true;
	}


	public function validate_user()
	{
		if (($_SESSION["login"]=='admin') and ($_SESSION["password"]=='123'))
			{
				return true;
			}
			else
			{
				$_SESSION["login"]='';
				$_SESSION["password"] ='';
				return false;
			}

	}
	
	public function get_data()
	{	
		//Поймем, авторизованный ли у нас пользователь
		$authorized = $this->validate_user();
		//Получим из сессии тип сортировки
		if ( isset($_SESSION["sort"]) )
		{ $this->sort=$_SESSION['sort'];
		}
		else
		{
			$_SESSION["sort"]=$this->sort;
		}
		switch ($this->sort) {
			case 1: $sort_by='id'; break;
				case 2:$sort_by='name'; break;
					case 3:$sort_by='mail'; break;
						case 4:$sort_by='complete'; break;
							default:$sort_by='id'; break;
		}
		//Получим номер страницы из сессии
		if ( isset($_SESSION["page"]) )
		{
            $this->page_index=$_SESSION["page"];
        }
		else {$this->page_index=1;}
		//Получим из сессии порядок сортировки
		if ( isset($_SESSION["sort_desc"]) )
		{ $this->sort_descending=$_SESSION['sort_desc'];
		}

		if ($this->sort_descending==true) {$sort_ad='DESC';} else {$sort_ad='ASC';}

		//Соединимся с БД

		global $db_host, $db_db, $db_charset, $db_user, $db_pass, $db_opt;
		$dsn = "mysql:host=$db_host;dbname=$db_db;charset=$db_charset";
		
		try {
			$pdo = new PDO($dsn, $db_user, $db_pass, $db_opt);
		  } catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			die();
		  }
		



		//Если нужно изменить отметку о выполнении
		if (($this->delta_chk_id>0) and ($this->validate_change_chk_data()))
		{
			$query = "UPDATE task SET complete=? WHERE id=?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$this->delta_chk_state,$this->delta_chk_id]);
		}

		//Если нужно изменить/добавить задачу

		if (($this->delta_task_id>-1) and ($this->validate_change_task_data()))
		{
			if ($this->delta_task_id==0)
			{ //Новая задача
				
				$query = "INSERT into task (name, mail, text, complete) VALUES (?, ?, ?, 0)";
				$stmt = $pdo->prepare($query);
				$stmt->execute([$this->delta_task_name,$this->delta_task_mail,$this->delta_task_text]);
				$show_toast_new_task=true;
			}
			else if ($authorized==true)
			{ //Изменение существующей
				//Сначала получим текст изменяемой задачи
				$query = "SELECT * FROM task WHERE id=?"; 	
				$stmt = $pdo->prepare($query);
				$stmt->execute([$this->delta_task_id]);
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				$task_text = $row['text'];
				$admin_edit = $row['admin_edit'];
				//Проверим, изсенился ли текст задачи
				if ($task_text!=$this->delta_task_text) {$admin_edit=1;}
				//Изменим задачу
				$query = "UPDATE task SET name=?, mail=?, text=?, admin_edit=? WHERE id=?";
				$stmt = $pdo->prepare($query);
				$stmt->execute([$this->delta_task_name,$this->delta_task_mail,$this->delta_task_text,$admin_edit,$this->delta_task_id]);
				$show_toast_edit_task=true;
			}
			else //Слетела авторизация 
			{
				$this->error_login=true;
			}
		}

				//Посчитаем значения для пагинации
				$query = "SELECT COUNT(*) AS num_rows FROM task"; 	
				$stmt = $pdo->prepare($query);
				$stmt->execute([]);
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				$this->page_items_count = $row['num_rows'];
				$this->page_count=ceil($this->page_items_count / $this->page_items_per_page);

		//Если нужно найти и выдать изменяемую задачу
		if ($this->changing_task_id>0) 
		{
			$query = "SELECT * FROM task WHERE id=?"; 	
			$stmt = $pdo->prepare($query);
			$stmt->execute([$this->changing_task_id]);
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$changing_task_name = $row['name'];
			$changing_task_mail = $row['mail'];
			$changing_task_text = $row['text'];

		}

		//Получим карточки
		$query = "SELECT * FROM task ORDER BY $sort_by $sort_ad LIMIT ?, 3";
		$stmt = $pdo->prepare($query);
		$stmt->execute([($this->page_index-1)*$this->page_items_per_page]);
        switch ($stmt->rowCount()) {
			case 0:$card_invisible[1]=true;
			case 1:$card_invisible[2]=true;
			case 2:$card_invisible[3]=true;	
            }		
		$i=0;
		foreach ($stmt as $row)
		{
			$i++;
			$card_id[$i] = $row['id'];
			$card_name[$i] = $row['name'];
			$card_mail[$i] = $row['mail'];
			$card_text[$i] = $row['text'];
			$card_complete[$i] = $row['complete'];
			$card_edited_by_admin[$i] = $row['admin_edit'];
			
		}


		
		return array(
			'sort_type' => $this->sort,
			'sort_descending' =>$this->sort_descending,

			'card_invisible' => $card_invisible,


			'card_id' =>$card_id,
			'card_name' =>$card_name,
			'card_mail' =>$card_mail,
			'card_text' =>$card_text,
			'card_chk' =>$card_complete,
			'card_edited_by_admin' =>$card_edited_by_admin,

			'authorized' =>$authorized,
			'error_login' => $this->error_login,
			
			'changing_task_id' => $this->changing_task_id,
			'changing_task_name' =>$changing_task_name,
			'changing_task_mail' =>$changing_task_mail,
			'changing_task_text' =>$changing_task_text,

			'page_items_per_page'=>$this->page_items_per_page,
			'page_items_count'=>$this->page_items_count,
			'page_count'=>$this->page_count,
			'page_index'=>$this->page_index,

			'show_toast_new_task'=>$show_toast_new_task,
			'show_toast_edit_task'=>$show_toast_edit_task

		);
	}

}
