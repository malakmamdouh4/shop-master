<?php
    $dept = new department($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['add'])){
            $dept -> create($_POST['name'],$_POST['desc'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name']);
        } else {
            $dept -> edit($_POST['id'],$_POST['name'],$_POST['desc'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name']);
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
        $check = $dept -> check($id);
        $deptEdit = $dept -> view($id);
        if ($check > 0){
            ?>
            <div class="container">
                <form class="w-100 border rounded border-dark " method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="form-group text-center border border-bottom">
                        <img src="<?php echo $deptPath . $deptEdit['img']; ?>" style="height: 500px;width: 100%" />
                    </div>
                    <div class="form-group position-relative">
                        <label for="head" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="head" name="name" value="<?php echo $deptEdit['name'];?>" />
                            <input type="hidden" value="<?php echo $deptEdit['ID'];?>" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="caption" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="caption" name="desc"  value="<?php echo $deptEdit['description'];?>"/>
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
            <?php
        } else {
            header('location: index.php');
            exit();
        }


    } elseif (isset($_GET['delete'])) {

        $id = isset($_GET['id']) ? $_GET['id'] : header('location: ' . $_SERVER['HTTP_REFERER']);
        $check = $dept -> check($id);
        if ($check > 0){
            $dept -> delete($id);
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            header('location: index.php');
            exit();
        }
    } else {
        $depts = $dept ->viewAll();
        ?>
            <div class="container">
                <a href="index.php?go=departments&add" class="btn btn-light text-decoration-none my-2" >Add Department <i class="fa fa-plus"></i> </a>
                <div class="row">
                    <?php
                        foreach ($depts as $dept){
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card my-2">
                                    <img src="<?php echo $deptPath . $dept['img'] ?>" class="card-img-top" alt="<?php echo $dept['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $dept['name']; ?></h5>
                                        <p class="card-text"><?php echo $dept['description']; ?></p>
                                        <a href="index.php?go=departments&edit&id=<?php echo $dept['ID']; ?>" class="btn btn-success">edit</a>
                                        <a href="index.php?go=departments&delete&id=<?php echo $dept['ID']; ?>" class="btn btn-danger confirm">delete</a>
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
