<?php
    $name="https://shere.ts4ever.pl/";
    $now = time();
    $logout_after = "9999999999";

    $server_ip = 'x.x.x.x';
    $ports = [11002, 29000, 29100, 29200, 29300];
    $db_name = 'account';
    $login = 'xxxxxx';
    $passwd = 'xxxxxx';
    $charset = "utf8";

    if (!isset($_SESSION))
        session_start();
    
    try
    {
        $dsn = "mysql:host=".$server_ip.";dbname=".$db_name.";charset=".$charset;
        $sql = new PDO($dsn, $login, $passwd);
        $sql -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        echo "Połączenie nieudane: ".$e->getMessage();
        exit;
    }

    require_once 'include/phpmailer/PHPMailer.php';
    require_once 'include/functions.php';
    require_once 'include/actions.php';
?>
