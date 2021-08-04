<?php

    $user = new user($con);
    $dept = new department($con);
    $item = new items($con);
    $client = new client($con);


    if ((!isset($_SESSION['username']) && !isset($_SESSION['id']) ) ){
        header('location: index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['editProfile'])){
            $user -> edit($_SESSION['id'],$_POST['name'],$_POST['email'],$_POST['pass'],$_FILES['avater']['name'],$_FILES['avater']['size'],$_FILES['avater']['tmp_name']);
        } elseif (isset($_POST['additem'])){
            $item -> create($_POST['name'],$_POST['desc'],$_POST['price'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name'],$_POST['dept'],$_SESSION['id']);
        }
    }

    if(isset($_GET['additem'])){
        ?>
        <div class="container">
            <form class="w-100" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="form-group ">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"  required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="desc" name="desc"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price"  />
                    </div>
                </div>
                <div class="form-group">
                    <?php
                    $depts = $dept -> viewAll();
                    ?>
                    <label for="department" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dept" >
                            <option></option>
                            <?php
                            foreach ($depts as $dept){
                                ?>
                                <option value="<?php echo $dept['ID']; ?>"><?php echo $dept['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="custom-file ">
                            <input type="file" class="form-control-file" id="img" name="img" >
                            <label class="custom-file-label " for="img" >Choose file...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="submit" class="form-control" name="additem" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    } elseif (isset($_GET['edit'])){
        $userEdit = $user -> view($_SESSION['id']);
        ?>
        <div class="container">
            <div class="text-center">
                <img src="<?php if(empty($userEdit['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $userEdit['avater']; } ?>"
                     class="img-thumbnail rounded-circle text-center"
                     style="height: 200px;width: 200px;">
            </div>
            <form class="w-100 my-5" id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=profile&edit" enctype="multipart/form-data">
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
                    <div class="col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="avater" name="avater" >
                            <label class="custom-file-label " for="avater" >Choose Your Avater...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" class="form-control" name="editProfile" />
                    </div>
                </div>
            </form>
        </div>
        <?php

    } elseif (isset($_GET['viewitem'])){
        ?>
        <div class="container">
            <div class="row">
                <?php
                $items = $item -> userItems($_SESSION['id']);
                foreach ($items as $item){
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card my-2">
                            <img src="<?php echo $itemPath . $item['img'] ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                <p class="card-text"><?php echo $item['description']; ?></p>
                                <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($item['date']); ?></small></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    } elseif (isset($_GET['orders'])){
        ?>
            <div class="container">
                <h3 class="my-2">Sold Items:</h3>
                <div class="row">
                    <?php
                        $orders = $client -> sold($_SESSION['id']);
                        if (empty($orders)){
                            echo 'no sold Items Yet';
                        } else {
                            foreach ($orders as $order){
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card  mb-3 " style="max-width: 18rem;">
                                        <div class="card-header text-white bg-success">
                                            <div class="row">
                                                <div class="col-5">
                                                    <?php echo $order['item']; ?>
                                                </div>
                                                <div class="col-6 ">
                                                    <span class="fa-pull-right">$<?php echo $order['price']; ?></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush ">
                                                <li class="list-group-item ">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            Name
                                                        </div>:
                                                        <div class="col-7">
                                                            <?php echo $order['name']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            Address
                                                        </div>:
                                                        <div class="col-7">
                                                            <?php echo $order['address']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            phone
                                                        </div>:
                                                        <div class="col-7">
                                                            <?php echo $order['phone']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            email
                                                        </div>:
                                                        <div class="col-7">
                                                            <?php echo $order['email']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($order['date']); ?></small></p>
                                                </li>


                                            </ul>
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
    } elseif (isset($_GET['done'])){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($id == 0){

            header('location: index.php');
            exit();

        } else {
            $client = new client($con);
            $order = $client -> view($_SESSION['id']);

            if ($_SESSION['id'] == $order['user_ID']){

                $client -> done($id);
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();

            } else {

                header('location: index.php');
                exit();

            }
        }

    } else {
        ?>
        <div class="container">
            <div class="profile text-center mt-2">
                <?php $userEdit = $user -> view($_SESSION['id']); ?>
                <img src="<?php if(empty($userEdit['avater'])){ echo $avaterPath . 'person.png';} else { echo $avaterPath . $userEdit['avater']; } ?>" class="img-thumbnail rounded-circle" style="height: 200px;width: 200px;">
                <div class="row my-5 w-75 mx-auto">
                    <?php
                        if ($userEdit['status'] == 1){
                            ?>
                            <div class="col-3 border-right p-1"><a href="index.php?go=profile&orders" class="text-decoration-none text-secondary"><i class="fas fa-tasks fa-2x"></i></i> </a></div>
                            <div class="col-3 border-right p-1"><a href="index.php?go=profile&viewitem" class="text-decoration-none text-secondary"><i class="fas fa-tags fa-2x"></i> </a></div>
                            <div class="col-3 border-right p-1"><a href="index.php?go=profile&additem" class="text-decoration-none text-secondary"><i class="fas fa-plus-circle fa-2x"></i></a></div>
                            <?php
                        } else {
                            ?>
                            <div class="col-9 border-right p-1">You Can Add Items After Admin Approval</div>
                            <?php
                        }
                    ?>
                    <div class="col-3 p-1"><a href="index.php?go=profile&edit" class="text-decoration-none text-secondary"><i class="fas fa-user-edit fa-2x"></i> </a></div>
                </div>
                <hr>
            </div>
            <div class="row">
                <?php


                $clients = $client -> viewAll($_SESSION['id']);

                if (empty($clients)){

                    echo '<p class="alert bg-dark text-white">no orders yet</p>';

                } else {

                    foreach ($clients as $client){
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $client['item']; ?></h5>
                                    <p class=""> </p>
                                    <p class=""></p>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    Name
                                                </div>:
                                                <div class="col-7">
                                                     <?php echo $client['name']; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    Address
                                                </div>:
                                                <div class="col-7">
                                                    <?php echo $client['address']; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    phone
                                                </div>:
                                                <div class="col-7">
                                                    <?php echo $client['phone']; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    email
                                                </div>:
                                                <div class="col-7">
                                                    <?php echo $client['email']; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="card-text"><small class="text-muted fa-pull-right"><?php echo time_ago($client['date']); ?></small></p>
                                        </li>


                                    </ul>
                                    <a href="index.php?go=profile&done&id=<?php echo $client['ID']; ?>" class="btn btn-success d-flex justify-content-center">Done</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                }
                ?>
            </div>
            <hr>
        </div>
        <?php
    }
