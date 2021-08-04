<?php
    ob_start();
    session_start();
    include 'connect.php';
    include 'init.php';

    $user = new user($con);
    $visiter = $user -> view($_SESSION['id']);
    if ($visiter['GroupID'] != 1){
        header('location: ../index.php');
        exit();
    }


    $go = isset($_GET['go']) ? $_GET['go'] : 'home';

    if ($go === 'dashboard'){

        include $dashboard;

    } elseif ($go === 'users'){

        include $users;

    } elseif($go === 'admins'){

        include $admin;

    } elseif($go === 'departments'){

        include $dept;

    } elseif($go === 'items'){

        include $items;

    }  elseif ($go === 'website'){

        include $slider;

    } else {
        header('location: index.php?go=dashboard');
    }
?>

<?php
    include $footer;
    ob_end_flush();
?>
