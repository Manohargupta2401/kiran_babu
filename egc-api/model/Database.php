<?php
class Database
{
    protected $connection = null;
 
    public function __construct()
    {
        try {
            // $conn = sqlsrv_connect($this->serverName, $this->connectionInfo);  
            $this->connection = sqlsrv_connect(DB_HOST, DB_DATABASE_NAME);
         
            if( $this->connection === false )
            {  
                 echo "Could not connect.\n";  
                 die( print_r( sqlsrv_errors(), true));  
            }
        } catch (Exception $e) {
            throw new Exception(sqlsrv_errors());   
        }           
    }
 
    public function query($query = "" , $params= [])
    {
        try {
            $stmt2 = $this->executeStatement( $query , $params);
            if($stmt2)
            {
             
                $result=array();
                while( $row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC )) 
                {
                    // $row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC );
            
                    $result[]=$row;
                }
          
                // $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
                // $stmt->close();
                
                return $result;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
 
    private function executeStatement($query = "" , $params = [])
    {
        try {
            
            $stmt=sqlsrv_query($this->connection, $query, $params);
    
            // $status=sqlsrv_query($conn, $tsql, $params);
            // $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }

            
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
}