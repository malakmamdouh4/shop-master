<?php

    $user = new user($con);
    $dept = new department($con);
    $item = new items($con);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if (isset($_POST['add'])){
            $item -> create($_POST['name'],$_POST['desc'],$_POST['price'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name'],$_POST['dept'],$_POST['user']);
        } else {
            $item -> edit($_POST['id'],$_POST['name'],$_POST['desc'],$_POST['price'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name'],$_POST['dept'],$_POST['user']);
        }
    }

    if (isset($_GET['add'])){
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
                        $users = $user -> viewAll();
                    ?>
                    <label for="user" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="user" >
                            <option></option>
                            <?php
                                foreach ($users as $user){
                                    ?>
                                        <option value="<?php echo $user['ID']; ?>"><?php echo $user['name']; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
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
                        <input type="submit" class="form-control" name="add" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    } elseif (isset($_GET['edit'])){

        $id = isset($_GET['id']) ? $_GET['id'] : header('location: ' . $_SERVER['HTTP_REFERER']);
        $check = $item -> check($id);
        $items = $item -> view($id);
        if ($check > 0){
           ?>
            <div class="container">
                <div class="container">
                    <form class="w-100" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-10 border">
                                <img src="<?php echo $itemPath . $items['img']; ?>" class="w-100" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"  value="<?php echo $items['name'];  ?>"/>
                                <input type="hidden" name="id" value="<?php echo $items['ID']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="desc" name="desc"  value="<?php echo $items['description'];  ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $items['price'];  ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $users = $user -> viewAll();
                            ?>
                            <label for="user" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="user" >
                                    <option></option>
                                    <?php
                                    foreach ($users as $user){
                                        ?>
                                        <option value="<?php echo $user['ID']; ?>" <?php if($user['ID'] === $items['user_ID']){ echo 'selected'; } ?>><?php echo $user['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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
                                        <option value="<?php echo $dept['ID']; ?>" <?php if($dept['ID'] === $items['dept_ID']){ echo 'selected'; } ?>><?php echo $dept['name']; ?></option>
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
                                <input type="submit" class="form-control" name="edit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }
    } elseif (isset($_GET['delete'])){

        $id = isset($_GET['id']) ? $_GET['id'] : header('location: ' . $_SERVER['HTTP_REFERER']);
        $check = $item -> check($id);
        if ($check > 0){
            $item -> delete($id);
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            header('location: index.php');
            exit();
        }

    }else {
        ?>
        <div class="container">
            <a href="index.php?go=items&add" class="btn btn-light my-2">Add item <i class="fa fa-plus"></i> </a>
            <div class="row">
                <?php
                    $items = $item -> itemInfo();
                    foreach ($items as $item){
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card my-2">
                                    <img src="<?php echo $itemPath . $item['img'] ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                        <p class="card-text"><?php echo $item['description']; ?></p>
                                        <p class="card-text"><?php echo $item['user']; ?> . <?php echo $item['dept']; ?></p>
                                        <p class="card-text"></p>
                                        <a href="index.php?go=items&edit&id=<?php echo $item['ID']; ?>" class="btn btn-success">edit</a>
                                        <a href="index.php?go=items&delete&id=<?php echo $item['ID']; ?>" class="btn btn-danger confirm">delete</a>
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
    }