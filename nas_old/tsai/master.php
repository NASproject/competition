<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title) ? $title : ''; ?></title>
        <link rel="stylesheet" type="text/css" href="css/css_reset.css" />
        <link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="jQuery/css/humanity/jquery-ui-1.9.1.custom.min.css" />
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link rel="stylesheet" type="text/css" href="css/<?php echo basename(getenv('SCRIPT_NAME'), '.php'); ?>.css" />
        <script type="text/javascript" src="plugin/jQuery/js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="plugin/jQuery/js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" src="plugin/bootstrap/js/bootstrap.js"></script>

        <script type="text/javascript" src="Js/<?php echo basename(getenv('SCRIPT_NAME'), '.php'); ?>.js"></script>
    </head>
    <body>

        <div id="wrapper" class ="container">
            <div id ="logo">
            </div>   
            <div id="header">
                <div id="userName"><?php echo isset($userName) ? $userName : ''; ?></div>
                <div id="ProTitle"><?php echo isset($proTitle) ? $proTitle : ''; ?></div>
            </div>
            <div id ="menu">
                <ul>
                    <li><a href ="query.php">專題搜尋</a></li>
                    <li><a href ="register.php">專題註冊</a></li>
                </ul>
            </div>    
            <div id="content"><?php echo isset($content) ? $content : ''; ?></div>
            <div id="footer">
                <div id="fBack"><a href="<?php echo isset($fBack) ? $fBack : ''; ?>"></a></div>
                <div id="fHome"><a href="<?php echo isset($fHome) ? $fHome : ''; ?>"></a></div>
                <div id="fOut"><a href="<?php echo isset($fOut) ? $fOut : ''; ?>"></a></div>
            </div>
        </div>
    </body>
</html>
