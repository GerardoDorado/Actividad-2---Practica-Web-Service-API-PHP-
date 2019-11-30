<?php
    function conexionPDO($u, $p, $db) {
        try {
            $dsn = "mysql:host=localhost;dbname=" . $db . ";charset=utf8";
            $connection = new PDO($dsn, $u, $p);
            return $connection;
        } catch (PDOException $pdeo) {
           error_log($pdeo->getMessage()); 
           echo "ERROR: ".$pdeo->getMessage();
        }
    }
?>