<?PHP 
session_start();
include ''.dirname(__FILE__).'/config.php';
include ''.dirname(__FILE__).'/conexion.php';
$lifetime = 60000;
session_set_cookie_params($lifetime);
ini_set("session.cookie_lifetime",$lifetime);
ini_set("session.gc_maxlifetime",$lifetime);
ini_set('max_execution_time', $lifetime);
if($_SESSION['username']){
    setcookie("id", $_SESSION['id'], time()+$lifetime);
    setcookie("username", $_SESSION['username'], time()+$lifetime);
    $login_status="OK";
} else {
  // debe de tener cookie si no los primeros sign in fallan
  
  if($_COOKIE['username']){
	$_SESSION['id'] = $_COOKIE['id'];
	$_SESSION['username'] = $_COOKIE['username'];
	$login_status="OK";
  } else {
      echo "entro3";
      header("Location: ../../index.php");
  }
}
?>