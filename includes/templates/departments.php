<?php
    $dept = new department($con);
    $items = new items($con);
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        if ($dept -> check($id) > 0){
            $itemDept = $items -> itemDept($id);
            $deptName = $dept -> view($id);
            ?>
                <div class="container">
                    <h1 class="text-center text-capitalize my-2"><?php echo $deptName['name']; ?></h1>
                    <div class="row">
                        <?php
                            if(empty($itemDept)){
                                echo '<p class="alert alert-light">There`s no Items To Show In This Department</p>';
                            } else {
                                foreach ($itemDept as $item){
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12">


                                            <div class="card   card-edit mt-2" style="width: 18rem;">
                                                <img src="<?php echo $itemPath . $item['img']; ?>" class="card-img-top img-card">
                                                <div class="card-body">
                                                    <h2 class="card-title head">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <span class="fa-pull-left"> <?php echo $item['name']; ?></span>
                                                            </div>
                                                            <div class="col-3">
                                                                <span class="fa-pull-right">$<?php echo $item['price']; ?></span>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                    <p class="card-text text"><?php echo $item['description']; ?></p>
                                                    <a href="index.php?go=item&id=<?php echo $item['ID']; ?>" class="btn show-more"> Show More....</a>
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
        } else {
            header('location: index.php');
            exit();
        }

    } else {
        ?>
        <div class="container">
            <div class="row">
                <?php
                    $depts = $dept -> viewAll();
                    foreach ($depts as $dept){
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 main">
                            <a href="index.php?go=dept&id=<?php echo $dept['ID']; ?>" class="text-decoration-none text-dark"><img src="<?php echo $deptPath . $dept['img']; ?>" /></a>
                            <h3><?php echo $dept['name']; ?></h3>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <?php
    }
?>
<div class="footer">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="first">
                <ul>
                    <li>   <i class="fas fa-map-marker-alt" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> Revolution Street Egypt  </li> <br> <br>
                    <li>   <i class="fas fa-phone" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> +15543543</li> <Br>   <br>
                    <li>   <i class="fas fa-envelope" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> Support@company.com </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="end">
                <h3> About The Company </h3>
                <p class="p-2">This company Don`t have a page on facebook, twitter, linked . It`s Experimental Website and This is icons for design</p>
                <ul>
                    <li>   <i class="fab fa-facebook" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i>  </li>
                    <li>   <i class="fab fa-twitter" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> </li>
                    <li>   <i class="fab fa-linkedin-in" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> </li>
                    <li>   <i class="fab fa-github" style="font-size: 25px;width: 20px;color: rgb(207, 67, 86);margin-left: 10px;margin-right: 15px ;"></i> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

