<?php

    $dsn    = 'mysql:host=localhost;dbname=newShop';       // Data Source Name
    $user   = 'root';
    $pass   = '';

    try {
        GLOBAL $con;
        $con = new PDO($dsn,$user,$pass);
//        $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo 'Failed To Connect ' . $e->getMessage();
    }

