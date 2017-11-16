<?PHP

require ''.dirname(__FILE__).'/../../PHPMailer/class.phpmailer.php';

class SendMail {

  public $server;
  public $asunto;
  public $body;
  public $mailQueRecibe;
  public $from;
  public $nombreQueEnvia;
  public $mailDes;
  public $email;
  public $date;
  public $headers;

  function __construct($server, $asunto, $body, $mailQueRecibe, $from, $nombreQueEnvia){
    /*
    $server  = "godaddy";
    $asunto = "New Message!";
    $body = "You have a new message from Cryptochalet.co";
    $mailQueRecibe = "manlioelnum1@hotmail.com";
    $from    = "info@cryptochalet.co";                             // mail que verá el receptor
    $nombreQueEnvia  = "Cryptochalet";
    */

    $log = new LoggerPhp();
    $log->write_log("[SendMail][__construct]","Debug");

    $this->server  = "godaddy";
    $this->asunto = $asunto;
    $this->body = $body;
    $this->mailQueRecibe = $mailQueRecibe;
    $this->from = $from;                             // mail que verá el receptor
    $this->nombreQueEnvia  = $nombreQueEnvia;
    $this->mailDes = $mailQueRecibe;                                // Mail Destino(a mandar)
    $this->email = $mailQueRecibe;                             // mail del cliente no se manda a el
    $this->date = date("D, d M Y H:i:s -0000");
    $this->headers = $this->headers();

  }

  function headers(){

    $headers = 'From: "'.$this->nombreQueEnvia.'" <'.$this->mailDes.'>
    Return-Path: '.$this->mailDes.'
    Date: '.$this->date.'
    X-Mailer: SMF
    Mime-Version: 1.0
    Content-Type: multipart/alternative; boundary="SMF-fd3a2ff78aeec0baba4bc352c33ca57f"
    Content-Transfer-Encoding: 7bit';

    return $headers;

  }

  function sendMail(){

    
    $log = new LoggerPhp();
    $log->write_log("[SendMail][sendMail]","Debug");

    $body=utf8_decode($this->body);
    $bodyHTML= $body;

    $mail = new PHPMailer;
    $mail->IsSMTP();        
                                    // Set mailer to use SMTP
    if($this->server=="bluehost"){                              
      $mail->Host = 'box894.bluehost.com';                  // Specify main and backup server
      $mail->Port = 465;                                    // Set the SMTP port
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'soporte@boogapp.com';              // SMTP username
      $mail->Password = 'boogapp.com';                      // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
    } else if($this->server=="mailchimp"){
      $mail->Host = 'smtp.mandrillapp.com'; 
      $mail->Mailer = "smtp";                               // Server remoto al que nos conectarémos
      $mail->Port = 587;                                    // Puerto SMTP
      $mail->SMTPAuth = true;                               // Autenticación SMTP
      $mail->Username = 'manlioelnum1@hotmail.com';         // Usuario
      $mail->Password = '';           // Password OJO! Es confidencial
    } else if($this->server=="godaddy"){    
      

        $log->write_log("[SendMail][sendMail] GoDaddy Server","Debug");
      
        $mail->Host = 'n3plcpnl0018.prod.ams3.secureserver.net';
        $mail->Port = 25;                                                       // Set the SMTP port
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'info@cryptochalet.co';                                // SMTP username
        $mail->Password = 'IGWEduf3h489iu43er';                                                  // Enable SMTP authentication
        //$mail->SMTPSecure = 'ssl';                                              // Enable encryption, 'ssl' also accepted
        //$mail->SMTPDebug = 4;  //more error details

        $mail->IsSMTP(); // enable SMTP
    }

    $mail->From = $this->from;
    $mail->FromName = $this->nombreQueEnvia;
    $mail->addAddress($this->mailDes, $this->nombreQueEnvia);
    $mail->AddBCC('manlioelnum1@hotmail.com');                       // Agregar Destinatario
    $mail->AddBCC('info@cryptochalet.co');                       // Agregar Destinatario
    // mail->AddAttachment("Sismo_".date("dmY").".pdf");    // Para que pongas el attachment
    $mail->IsHTML(true);                                                                                                 // Formato HTML
    $mail->Subject = ''.$this->asunto.'';
    $mail->Body    = $bodyHTML;
    $mail->AltBody = $bodyHTML;

    
    if($mail->Send()){
      
      $log = new LoggerPhp();
      $log->write_log("[SendMail][sendMail] Success","Debug");
      
    } else { 
      $log = new LoggerPhp();
      $log->write_log("[SendMail][sendMail] no success","Debug");
      $log->write_log("[SendMail][sendMail] 'Error: ".$mail->ErrorInfo." ".$mail->Host."","Debug");
      echo 'Error: '.$mail->ErrorInfo.' '.$mail->Host.''; 
    }
    //$mail->ClearAllRecipients();                       //Limpiar Destinatarios para nuevo Desti..
     
  }

}   

?>