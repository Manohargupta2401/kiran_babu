<?php
class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function get_login_token($key,$email,$password)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
          
                $email1=trim($email);

                $password1=hash('sha256', $password);
                $prams=['@strEmailAddress','@strPassword'];
                $value=array($email1,$password1);
             
                $Users_auth = $userModel->call_store_procedure("spGetPortalUserAuth",$prams,$value);
             
                $responseData = $Users_auth;
                
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            return $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            echo $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function ms_sql_execute($query,$param=array())
    {
        $strErrorDesc = '';

        try {
            $userModel = new UserModel();
            $Users_auth = $userModel->sql_execute($query,$param);
            
            $responseData = $Users_auth;
            
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
    
 
        // send output
        if (!$strErrorDesc) {
            return $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            echo $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function get_header($key)
    {
        $getHeaders = apache_request_headers();
        if($key)
        {
            if($getHeaders[$key])
            {
                return $getHeaders[$key];
            }
            else
            {
                return false;
            }
            
        }
        else
        {
            return false;
        }
        
    }

    public function get_all_catalog($userid,$customerId)
    {
        $userModel = new UserModel();

        $value=array($userid,$customerId);
        $params=['@intUserID','@intCustomerID'];

        $All_Catalog = $userModel->call_store_procedure("spGetPortalCatalog",$params,$value);
      

        // $tsql="EXEC spGetPortalCatalog =?, @intCustomerID=?";
        // $status=sqlsrv_query($conn, $tsql, $params);
        // while( $row = sqlsrv_fetch_array( $status, SQLSRV_FETCH_ASSOC )) {
    
        //     $row = sqlsrv_fetch_array( $status, SQLSRV_FETCH_ASSOC );
     
        //     $data=array('status'=>200, 'message' => $row);
        //     echo json_encode($data);
            
        // }
      
        return $All_Catalog;
    }
}