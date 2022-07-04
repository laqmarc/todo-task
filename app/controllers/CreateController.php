<?php
require_once ROOT_PATH . '/app/models/data.php';
class CreateController extends ApplicationController
{
	public function indexAction()
	{
		$this->view->message = "hello from Index::index";
	}
	
	public function createAction()
	{
		if (isset($_POST['boto-summit']))
		{
		
			$file = file_get_contents("data.json");
			$data = json_decode($file, true);
			$last = end($data);
		
			$id = $last['id'];
			$time_actual = time();
			$next_id = ++$id;
			$data[] = array(
				'id'             => $next_id,
				'text'           => $_POST["text"],
				"time_start"     => $time_actual,
				"time_finish"    => $time_actual,
				"name_user"      => $_POST["name_user"],
				"status"         => $_POST["status"]
			);
		
			file_put_contents('data.json',json_encode($data), LOCK_EX);
			header("Location: /todo-task/web/");	
		}
		
		else
		{
			header("Location: /todo-task/web/new");
		}
	}
}