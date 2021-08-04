<?php
    $user = new user($con);
    if (!isset($_GET['add']) && !isset($_GET['show']) && !isset($_GET['setadmin']) && !isset($_GET['unset'])){
        ?>
            <div class="container">
                <h2 class="text-center">Admins</h2>
                <div class="row text-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                        <a href="index.php?go=admins&show" class="text-decoration-none text-dark">
                            <div class="bg-light px-2 py-3">
                                <div style="font-size: 40px">Admins</div>
                                <i class="fas fa-user-tie fa-5x"></i> <span style="font-size: 80px"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                        <div class="bg-light px-2 py-3">
                            <a href="index.php?go=admins&add" class="text-decoration-none text-dark">
                                <div style="font-size: 40px">Add Admin</div>
                                <i class="fas fa-users-cog fa-5x"></i> <span style="font-size: 80px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    } elseif (isset($_GET['add'])){
        ?>
        <div class="container">
            <div class="row">
                <?php
                   $users = $user -> viewActive();
                   if (empty($users)){
                       echo '<p class="alert bg-light text-dark w-100">There`s Activate Users To Show & Set as Admin</p>';
                   }
                   foreach ($users as $u){
                       ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                            <div class="card border-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-secondary">
                                    <a href="index.php?go=admins&setadmin&id=<?php echo $u['ID']; ?>" class="btn bg-dark text-white">Set As Admin</a>
                                </div>
                                <div class="card-body text-center">
                                    <img src="<?php if(empty($u['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $u['avater']; } ?>" style="height: 200px;width: 200px" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="card-footer bg-transparent border-secondary">
                                    <p>UserName: <?php echo $u['name'] ?></p>
                                    <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($u['Date']); ?></small></p>
                                </div>
                            </div>
                        </div>
                       <?php
                   }
                ?>
            </div>
        </div>
        <?php
    } elseif (isset($_GET['setadmin'])){

        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;
        if ($user -> check($id) > 0){
            $user -> addAdmin($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ../index.php' );
            exit;
        }

    } elseif (isset($_GET['show'])){
        ?>
        <div class="container">
            <div class="row">
                <?php
                $users = $user -> viewAdmins();
                    foreach ($users as $u){
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                            <div class="card border-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-secondary">
                                    <a href="index.php?go=admins&unset&id=<?php echo $u['ID']; ?>" class="btn btn-dark text-white">Unset</a>
                                </div>
                                <div class="card-body text-center">
                                    <img src="<?php if(empty($u['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $u['avater']; } ?>" style="height: 200px;width: 200px" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="card-footer bg-transparent border-secondary">
                                    <p>UserName: <?php echo $u['name'] ?></p>
                                    <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($u['Date']); ?></small></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                         $admin = $user -> admin();
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                        <div class="card border-secondary mb-3" style="max-width: 18rem;">
                            <div class="card-body text-center">
                                <img src="<?php if(empty($admin['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $admin['avater']; } ?>" style="height: 200px;width: 200px" class="img-thumbnail rounded-circle">
                            </div>
                            <div class="card-footer bg-transparent border-secondary">
                                <p>UserName: <?php echo $admin['name'] ?></p>
                                <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($admin['Date']); ?></small></p>
                            </div>
                        </div>
                    </div>
                    <?php
                ?>
            </div>
        </div>
        <?php
    } elseif (isset($_GET['unset'])){
        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;
        $a = $user -> view($id);
        if ($a['status'] == 0){
            header('location:index.php');
            exit();
        }
        if ($user -> check($id) > 0){
            $user -> removeAdmin($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ../index.php' );
            exit;
        }
    }