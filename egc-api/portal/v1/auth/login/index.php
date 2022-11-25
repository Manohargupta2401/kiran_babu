<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ("../../../../lib/main.php");

require_once('php_jwt_token/src/BeforeValidException.php');
require_once('php_jwt_token/src/CachedKeySet.php');
require_once('php_jwt_token/src/ExpiredException.php');
require_once('php_jwt_token/src/JWK.php');
require_once('php_jwt_token/src/JWT.php');
require_once('php_jwt_token/src/BeforeValidException.php');

require_once('php_jwt_token/src/SignatureInvalidException.php');





use Firebase\JWT\JWT;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$count=count($uri);
$index=$count-2;

if ((isset($uri[$index]) && $uri[$index] != 'login') || !isset($uri[$index])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
$objFeedController = new UserController();

$key=$objFeedController->get_header('key');

$error=new ErrorMessage();
$response= new Response();
if($key)
{
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if (strtoupper($requestMethod) == 'POST') 
    {
        try
        {
            if($_REQUEST['email_id'] && $_REQUEST['password'])
            {
    
                $email=$_REQUEST['email_id'];
                $password=$_REQUEST['password'];
              
                $arr=$objFeedController->get_login_token($key,$email,$password);
                if($arr[0]['strActivationCode']==$key)
                {
                    $Payload=array(
                        "email"=>$email,
                        "browser"=>"Chrome 107",
                        "platform"=>"Windows 10",
                        "hardware"=>"computer",
                        "ipAddress"=>"12.25.255.55",
                        "ipLocation"=>"Portalnd, OR (US)"
                        );
                        
                        $jwt= JWT::encode($Payload,$key,'HS256');
                
                
                        $params2=array($jwt,$key);
                        $objFeedController->ms_sql_execute("UPDATE tblPortalUser SET jwt_token=? where strActivationCode=?",$params2);
                    
                        $myarray['Status']=200;
                        $myarray['message']="login successful!";
                        // ,"account"=>array("userId"=>$status34['intUserID'],"email"=>$status34['strEmailAddress']),"companies"=>array());
                        $myarray['data']=array("token"=>$jwt,"account"=>array("UserID"=>$arr[0]['intUserID'],"email"=>$arr[0]['strEmailAddress']),"companies"=>array());
                        $response->jsonResponse($myarray);
                        die;
                }
                else
                {
                    echo json_encode($error->Key_Error);
                    die;
                }
        
            }
        }
        catch (Error $e) 
        {
            echo json_encode($error->UNKNOWN_ERROR);
            die;
        }
        

        
    }
    else
    {
        echo json_encode($error->Post_Request_Error);
        die;
    }

    

  
}
else
{
    echo json_encode($error->Key_Missing);
    die;
}


?>
