<?php

    $header       = 'includes/templates/header.php';
    $nav          = 'includes/templates/navbar.php';
    $home         = 'includes/templates/home.php';
    $form         = 'includes/templates/form.php';
    $profile      = 'includes/templates/profile.php';
    $departments  = 'includes/templates/departments.php';
    $item         = 'includes/templates/item.php';
    $buy          = 'includes/templates/buy.php';
    $search       = 'includes/templates/search.php';
    $logout       = 'includes/templates/logout.php';
    $footer       = 'includes/templates/footer.php';
    $func         = 'includes/functions/func.php';
    $user         = 'includes/objects/user.php';
    $department   = 'includes/objects/department.php';
    $classSlider  = 'includes/objects/slider.php';
    $classItem    = 'includes/objects/items.php';
    $client       = 'includes/objects/client.php';

    $path       = 'data/uploads/slider/';
    $avaterPath = 'data/uploads/avaters/';
    $itemPath   = 'data/uploads/items/';
    $deptPath   = 'data/uploads/departments/';

    include $user;
    include $func;
    include $header;
    if (!isset($noNav)){
        include $nav;
    }
    include $department;
    include $classSlider;
    include $classItem;
    include $client;