<?php
    ob_start();
    session_start();

    include 'admin/connect.php';
    include 'init.php';

    $go = isset($_GET['go']) ? $_GET['go'] : 'home';
    $seo = isset($_GET['search']) ? $_GET['search']: 0 ;
    if ($go === 'home'){

        include $home;

    } elseif ($go === 'dept'){

      include $departments;

    }  elseif ($go === 'join'){

        include $form;

    } elseif ($go === 'profile'){

        include $profile;

    } elseif ($go === 'item'){

        include $item;

    } elseif ($go == 'buy'){

        include $buy;

    } elseif ($go === 'logout'){

        include $logout;

    } elseif ($go === 'search'){

        include $search;

    } else {

        header('location: index.php');

    }

    include $footer;
    ob_end_flush();