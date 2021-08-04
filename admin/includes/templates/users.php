

<?php
    $user = new user($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        if (isset($_POST['add'])){
            $user -> create($_POST['name'],$_POST['email'],$_POST['pass']);
        } else {
            $user -> edit($_POST['id'],$_POST['name'],$_POST['email'],$_POST['pass'],'','','');
        }

    }


    if (!isset($_GET['active']) && !isset($_GET['pending']) && !isset($_GET['delete']) && !isset($_GET['add']) && !isset($_GET['activate']) && !isset($_GET['edit'])){

        ?>
        <div class="container">
            <h2 class="text-center">Users</h2>
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                    <a href="index.php?go=users&active" class="text-decoration-none text-dark">
                        <div class="bg-light px-2 py-3">
                            <div style="font-size: 40px">Active</div>
                            <i class="fas fa-user-check fa-5x"></i> <span style="font-size: 80px"><?php echo $user -> countActive(); ?></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                    <div class="bg-light px-2 py-3">
                        <a href="index.php?go=users&pending" class="text-decoration-none text-dark">
                            <div style="font-size: 40px">Pending</div>
                            <i class="fas fa-user-times fa-5x"></i> <span style="font-size: 80px"><?php echo $user -> countPending(); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 col-sm-12 mt-3">
                    <div class="bg-light px-2 py-3">
                        <a href="index.php?go=users&add" class="text-decoration-none text-dark">
                            <div style="font-size: 40px">Add User</div>
                            <i class="fas fa-user-plus fa-5x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } elseif (isset($_GET['active'])){
        $active = $user -> viewActive();
        ?>
            <div class="container">
                <div class="row">
                    <?php
                    if (empty($active)){
                        echo '<p class="alert bg-light text-dark w-100">There`s No Active Users To Show</p>';
                    } else {
                        foreach ($active as $a){
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card border-success my-3 " style="max-width: 18rem;">
                                    <div class="card-header bg-transparent border-success">
                                        <a href="index.php?go=users&edit&id=<?php echo $a['ID']; ?>" class="btn btn-success">Edit</a>
                                        <a href="index.php?go=users&delete&id=<?php echo $a['ID']; ?>" class="btn btn-danger confirm">delete</a>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="<?php if(empty($a['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $a['avater']; } ?>" style="height: 200px;width: 200px" class="img-thumbnail rounded-circle">
                                    </div>
                                    <div class="card-footer bg-transparent border-success">
                                        <p>UserName: <?php echo $a['name'] ?></p>
                                        <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($a['Date']); ?></small></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                 ?>
                </div>
            </div>
        <?php
    } elseif (isset($_GET['pending'])){
        $pends = $user -> viewPending();
        ?>
        <div class="container">
                <div class="row">
                    <?php
                    if (empty($pends)){
                        echo '<p class="alert bg-light text-dark w-100">There`s No Pending Users To Show</p>';
                    } else{
                        foreach ($pends as $pend){
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card border-primary my-3" style="max-width: 18rem;">
                                    <div class="card-header bg-transparent border-primary">
                                        <a href="index.php?go=users&activate&id=<?php echo $pend['ID']; ?>" class="btn btn-primary">Activate</a>
                                        <a href="index.php?go=users&delete&id=<?php echo $pend['ID']; ?>" class="btn btn-danger confirm" >delete</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="<?php if(empty($pend['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $pend['avater']; } ?>" style="height: 200px;width: 200px" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-primary">
                                        <p>UserName: <?php echo $pend['name']; ?></p>
                                        <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($pend['Date']); ?></small></p>
                                    </div>
                                </div>
                            </div> <?php
                        }
                    }
                     ?>
                </div>
        </div>
        <?php
    } elseif (isset($_GET['delete'])) {


        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;

        if ($user -> check($id) > 0){
            $user -> delete($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ../index.php' );
            exit;
        }

    } elseif (isset($_GET['add'])){

        ?>
        <div class="container">
            <form class="w-100 my-5" id="registration_form" method="POST" name="add" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=users&add">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="form_name" name="name"  />
                        <span class="text-danger" id="name_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="form_email" name="email"  />
                        <span class="text-danger" id="email_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_password" name="pass" />
                        <span class="text-danger" id="password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">Re-Type PassWord</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_retype_password"  />
                        <span class="text-danger" id="form_retype_password"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="submit" class="form-control" name="add"  />
                </div>
            </form>
        </div>
        <?php

    } elseif (isset($_GET['activate'])){

        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;

        if ($user -> check($id) > 0){
            $user -> activate($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ../index.php' );
            exit;
        }

    } elseif (isset($_GET['edit'])){
        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;
        if ($user -> check($id) > 0){
               $userEdit = $user -> view($id);
               if ($userEdit['status'] != 1){
                   header('location:index.php');
                   exit();
               }
            ?>
            <div class="container">
                <form class="w-100 my-5" id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=users&edit&id=<?php echo $userEdit['ID']; ?>">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="form_name" name="name" value="<?php echo $userEdit['name']; ?>" />
                            <input type="hidden" value="<?php echo $userEdit['ID']; ?>" name="id" />
                            <span class="text-danger" id="name_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="form_email" name="email"  value="<?php echo $userEdit['email']; ?>"/>
                            <span class="text-danger" id="email_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-sm-2 col-form-label">PassWord</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="form_password" name="pass" value=""/>
                            <span class="text-danger" id="password_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-sm-2 col-form-label">Re-Type PassWord</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="form_retype_password"  value=""/>
                            <span class="text-danger" id="form_retype_password"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="submit" class="form-control"  />
                    </div>
                </form>
            </div>
            <?php
        } else {
            header('Location: ../index.php' );
            exit;
        }

    } else {
        header('location: index.php?go=users');
    }
?>