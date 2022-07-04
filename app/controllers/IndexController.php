<?php

class IndexController extends ApplicationController
{
	public function indexAction()
	{
		$this->view->message = "hello from Index::index";
	}
	
	public function checkAction()
	{
		echo "hello from Index::check";
	}

	public function deleteAction(){

		$id = $_GET['id'];

		if($id) {
			$content = file_get_contents("data.json");
			$data = json_decode($content, true); 
			foreach ($data as $key => $value){ 
				
				if ($value['id'] == $id){ 
	
					$data = new Data();
					$data->deleteTask($id);
				} 
			}   
		}
	
        header("Location: /todo-task/web/");
	
	}

}
