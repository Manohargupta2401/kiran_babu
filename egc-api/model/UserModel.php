<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function call_store_procedure($name,$param=[],$value=[])
    {
        $query='';
        if($param)
        {
            $query=implode('=?,',$param);
            $query.='=?';
        }
        // $d=$this->query("EXEC $name $query", $value);
        // var_dump($d);
        // die;
         return $this->query("EXEC $name $query", $value);
    }
    public function sql_execute($query,$param=[])
    {        
         return $this->query($query,$param);
    }
}