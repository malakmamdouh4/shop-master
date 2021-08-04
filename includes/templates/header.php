<html lang="en">
    <head>
        <?php $css = 'layout/css/'; ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>all.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>style.css">
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
        <title><?php title(); ?></title>
    </head>
    <body style="<?php if(isset($_GET['go']) && $_GET['go'] === 'join'){echo 'background-color: rgb(165, 92, 92);';} ?>" >
