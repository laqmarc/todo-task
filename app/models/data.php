<?php
class Data extends Model
{
    private $jsonData;

    public function __construct()
    {
        $content = file_get_contents("data.json");
        $this->jsonData = json_decode($content, true); 
    }

    public function  jsonData()
    {
        return $this->jsonData;
    }


    public function deleteTask($id)
    {

        $data = $this->jsonData;  
        
        foreach ($data as $key => $value){ 
            
            if ($value['id'] == $id)
            { 
                unset($data[$key]);
            } 
        } 

        $this->updateJsonData($data);
    }

    public function updateState($id, $status)
    {
        $data = $this->jsonData;
        
        $newObject = [];
        foreach ($data as $key => $value)
        { 
            if ($value['id'] == $id)
            {
                $data[$key]['status'] = $status;

                if($status == "finish")
                {
                    $data[$key]['time_finish'] = time();
                }
                
                $newObject = $data[$key];
            } 
        }

        $this->updateJsonData($data);  
        echo json_encode($newObject);
    }

    public function updateTask($id, $taskData)
    {
        $data = $this->jsonData;
        
        foreach ($data as $key => $value)
        { 
            if ($value['id'] == $id)
            {
                $data[$key]['text'] = $taskData['text'];
                $data[$key]['name_user'] = $taskData['name_user'];
                $data[$key]['status'] = $taskData['status'];

            } 
        }

        $this->updateJsonData($data);

    }

    private function updateJsonData($data) 
    {
        $this->jsonData = $data;
        file_put_contents('data.json', json_encode($data, LOCK_EX)); 
    }

}

?> 