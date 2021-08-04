<?php



    $header       = 'includes/templates/header.php' ;
    $nav          = 'includes/templates/navbar.php' ;
    $dashboard    = 'includes/templates/dashboard.php' ;
    $users        = 'includes/templates/users.php' ;
    $admin        = 'includes/templates/admin.php' ;
    $slider       = 'includes/templates/slider.php' ;
    $items        = 'includes/templates/items.php';
    $dept         = 'includes/templates/departments.php' ;
    $footer       = 'includes/templates/footer.php' ;
    $func         = 'includes/functions/func.php';
    $user         = 'includes/objects/user.php';
    $department   = 'includes/objects/department.php';
    $classSlider  = 'includes/objects/slider.php';
    $classItem    = 'includes/objects/items.php';

    $sliderPath = '../data/uploads/slider/';
    $avaterPath = '../data/uploads/avaters/';
    $deptPath = '../data/uploads/departments/';
    $itemPath = '../data/uploads/items/';

    include $func;
    include $header;
    if (!isset($noNav)){
        include $nav;
    }

    include $user;
    include $department;
    include $classSlider;
    include $classItem;