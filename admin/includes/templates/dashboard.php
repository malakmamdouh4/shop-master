        <?php
            $user = new user($con);
            $dept = new department($con);
            $item = new items($con);
        ?>
        <div class="container">
            <div class="row" >
                <div class="col-lg-4 col-md-4 mt-3 bg-light p-2 text-center d-flex justify-content-center flex-column">
                    <a href="index.php?go=users" class="text-decoration-none text-dark">
                        <div>
                            <div style="font-size: 40px">Users</div>
                            <i class="fa fa-users fa-5x"></i><span style="font-size: 80px"> <?php echo $user -> countUser(); ?></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 col-md-4 text-center">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <a href="index.php?go=items" class="text-decoration-none text-dark">
                                <div class="bg-light p-2"><div style="font-size: 40px">Items</div>
                                    <i class="fas fa-file-invoice-dollar fa-5x"></i> <span style="font-size: 80px">&nbsp;<?php echo $item ->count(); ?></span></div>
                            </a>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <a href="index.php?go=admins" class="text-decoration-none text-dark">
                                <div class="bg-light p-2"><div style="font-size: 40px">Admins</div>
                                    <i class="fas fa-user-tie fa-5x"></i> <span style="font-size: 80px"> <?php echo $user -> countAdmin(); ?></span></div>
                            </a>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 mt-3">
                            <a href="index.php?go=departments" class="text-decoration-none text-dark">
                                <div class="bg-light p-2"><div style="font-size: 40px;word-wrap: break-word;">Departments</div>
                                    <i class="fa fa-cubes fa-5x"></i> <span style="font-size: 80px"><?php echo $dept -> count(); ?></span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
