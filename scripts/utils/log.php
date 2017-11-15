<?PHP

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class LoggerPhp {

    function __construct(){

    }

    /**
    * Escribe lo que le pasen a un archivo de logs
    * @param string $cadena texto a escribir en el log
    * @param string $tipo texto que indica el tipo de mensaje. Los valores normales son Info, Error,  
    *                                       Warn Debug, Critical
    */
    function write_log($cadena,$tipo)
    {   
        $arch = fopen(dirname(__FILE__)."/../../logs/milog_".date("Y-m-d").".txt", "a+"); 

        @fwrite($arch, "[".date("Y-m-d H:i:s.u")." ".$_SERVER['REMOTE_ADDR']." ".
                    $_SERVER['HTTP_X_FORWARDED_FOR']." - $tipo ] ".$cadena."\n");
        @fclose($arch);
    }

}

?>