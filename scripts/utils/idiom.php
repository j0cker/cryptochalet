<?PHP 
    session_start();
    include ''.dirname(__FILE__).'/functions.php';

    if(!empty($_GET["idiom"])){
        if($_GET["idiom"]=="es"){
            include ''.dirname(__FILE__).'/../../idioms/spanish.php';
            $_SESSION['idiom'] = "es";
        } else if($_GET["idiom"]=="en"){
            include ''.dirname(__FILE__).'/../../idioms/english.php';
            $_SESSION['idiom'] = "en";
        } else {
            include ''.dirname(__FILE__).'/../../idioms/english.php';
            $_SESSION['idiom'] = "en";
        }

    } else if(!empty($_SESSION['idiom'])){
        if($_SESSION['idiom']=="es"){
            include ''.dirname(__FILE__).'/../../idioms/spanish.php';
        } else if($_SESSION["idiom"]=="en"){
            include ''.dirname(__FILE__).'/../../idioms/english.php';
        } else {
            include ''.dirname(__FILE__).'/../../idioms/english.php';
        }

    } else {
        include ''.dirname(__FILE__).'/../../idioms/english.php';

    }

?>