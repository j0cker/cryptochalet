<?PHP

include ''.dirname(__FILE__).'/../utils/conexion.php';
include ''.dirname(__FILE__).'/../utils/functions.php';
include ''.dirname(__FILE__).'/../utils/log.php';
include ''.dirname(__FILE__).'/../utils/sendMails.php';

$nameContact =  base_de_datos_scape($conn, $_POST["nameContact"]);
//$numberContact =  base_de_datos_scape($conn, $_POST["numberContact"]);
$emailContact =  base_de_datos_scape($conn, $_POST["emailContact"]);
$commentContact =  base_de_datos_scape($conn, $_POST["commentContact"]);

$log = new LoggerPhp();
$log->write_log("[contacto]","Debug");

$obj = new stdclass();
$obj->success = "";
$obj->description = "";

if($nameContact!="" && $emailContact!="" && $commentContact!=""){

    $query = $conn->query("INSERT INTO contactoform (`name`,`number`,`mail`,`comments`) VALUES ('".$nameContact."','".$numberContact."','".$emailContact."','".$commentContact."')");
    if($query===true){
        $obj->success = "true";
        $obj->description = "";

        $server  = "godaddy";
        $asunto = "Cryptochalet.co Contact Form";
        $body = "";
        $body = "".$body."Name: ".$nameContact."<br />";
        //$body = "".$body."Number: ".$numberContact."<br />";
        $body = "".$body."Email: ".$emailContact."<br />";
        $body = "".$body."Comment: ".$commentContact."";
        $mailQueRecibe = "manlioelnum1@hotmail.com";
        $from    = "info@cryptochalet.co";                             // mail que verá el receptor
        $nombreQueEnvia  = "Cryptochalet";
        
        
        $SendMail = new SendMail($server, $asunto, $body, $mailQueRecibe, $from, $nombreQueEnvia);
        $SendMail->sendMail();
    } else {
        $obj->success = "false";
        $obj->description = "Error. Please Contact your administrator";
    }
} else {
    $obj->success = "false";
    $obj->description = "Error. you didnt complete all the contact form. Please complete it.";
}
echo json_encode($obj);

?>