<?php

class UpdateController extends ApplicationController
{
	public function indexAction()
	{

		$id = $_GET['id'];

		$tasks = new Data();
		foreach ($tasks->jsonData() as $key => $value)
        { 
            if ($value['id'] == $id)
            {
				$this->view->task = $value;
			}
		}

		if (!$this->view->task) {
			header("Location: /todo-task/web");
		}
	}

	public function updateStateAction()
    {
		$body = json_decode(file_get_contents('php://input'),true);
		$model = new Data();
		$model->updateState($body['id'],$body["status"]);
		exit();

    }

	public function updateTaskAction()
	{
		if (isset($_POST['boto-summit']))
		{
	
			$id = $_POST['id'];
			$taskData = array(
				'text'           => $_POST["text"],
				"name_user"      => $_POST["name_user"],
				"status"         => $_POST["status"]
			);

			$data = new Data();
			$data->updateTask($id, $taskData);
		
			header("Location: /todo-task/web/");	
		}
		else{
			header("Location: /todo-task/web/new");
		}
	}

}
