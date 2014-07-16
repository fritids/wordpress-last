<?php

function get_admin_msg() {
    $db = new PDO('mysql:host=localhost;dbname=wordpress;charset=utf8', 'wordpressuser', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    $command = "SELECT * FROM admin_messages";

    try {
        $query = $db->prepare($command);
        $query->execute();

        if($query->rowCount()>0) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        else {
            return 0;
        }

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

