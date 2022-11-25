<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ("../../../lib/main.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$count=count($uri);
$index=$count-2;

// if ((isset($uri[$index]) && $uri[$index] != 'catalog') || !isset($uri[$index])) {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }

$objFeedController = new UserController();

$key=$objFeedController->get_header('Authorization');

$error=new ErrorMessage();
$response= new Response();
if($key)
{

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if (strtoupper($requestMethod) == 'GET') 
    {
        
        
        if($_REQUEST['userId'] and $_REQUEST['customerId'])
        {
            try
            {
                $userid=$_REQUEST['userId'];
                $customerId=$_REQUEST['customerId'];
                $params2=array($userid);
                $data=$objFeedController->ms_sql_execute('select jwt_token from tblPortalUser where intUserID=?',$params2);
             
                $data[0]['jwt_token']="Bearer ".$data[0]['jwt_token'];
                if($data[0]['jwt_token']==$key)
                {
                    // echo json_encode($data[0]['jwt_token']);
                    // die;





                    $data2=$objFeedController->get_all_catalog($userid,$customerId);
                    // var_dump($data2);
                    // $response->jsonResponse($data2[0]);
                    // echo json_encode( $data2, JSON_UNESCAPED_UNICODE );
                    echo json_encode((object) $data2 , JSON_INVALID_UTF8_IGNORE);
                    die;
        

                }
                else
                {
                    echo json_encode($error->Key_Error);
                    die;
                }
            
                
            }
            catch (Error $e) 
            {
                echo json_encode($error->UNKNOWN_ERROR);
                die;
            }
        }

    }
}
?>