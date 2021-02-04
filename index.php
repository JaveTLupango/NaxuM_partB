 <?php 

require_once 'config/connection.php';  //calling connection class where in config folder
require_once 'class/Insert_class.php';   //calling insert class where in class folder
require_once 'class/Select_class.php';   //calling select class where in class folder 

$c_con = new ClassConnection();  // declare class in globe connection
$c_insert = new InsertionClass(); // declare class in globe insertion
$c_select = new SelectionClass(); // declare class in globe selection

$conn = $c_con->f_connection();

if ($conn==="fail")
{
	 echo '<center><h1>Connection Failed</h1></center>';
}
else
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST']."/project/exam/partB/";
	 echo '<!DOCTYPE html>
	        <html class="no-js">';
	        include "view/partial/head.php";
	        echo '<body class="hold-transition login-page">';   
	         include "view/registration.php";
			 include "view/partial/js.php";
	 echo '</body></html>';
}

