<?php

    $slider = new slider($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['addSlider'])){
            $slider -> add($_POST['head'],$_POST['caption'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name']);
        }
    }

    if (isset($_GET['add'])){
        ?>
        <div class="container">
            <form class="w-100" method="POST" name="addSlider" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="form-group ">
                    <label for="head" class="col-sm-2 col-form-label">Head</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="head" name="head"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="caption" class="col-sm-2 col-form-label">Caption</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="caption" name="caption"  />
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
                        <input type="submit" class="form-control" name="addSlider" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    } elseif (isset($_GET['edit'])){
            ?>
            <div class="container">
                <?php
                    $slides = $slider -> viewAll();
                    foreach ($slides as $slide){
                        ?>
                        <form class="w-100 border rounded border-dark " method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <div class="form-group text-center border border-bottom">
                                <img src="<?php echo $sliderPath . $slide['img']; ?>" style="height: 500px;width: 100%" />
                            </div>
                            <div class="form-group position-relative">
                                <a href="index.php?go=website&delete&id=<?php echo $slide['ID']; ?>" class="btn btn-danger position-absolute confirm " style="top:0px;right: 5px;z-index: 3">Delete</a>
                                <label for="head<?php echo $slide['ID']; ?>" class="col-sm-2 col-form-label">Head</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="head<?php echo $slide['ID']; ?>" name="head" value="<?php echo $slide['head'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="caption<?php echo $slide['ID']; ?>" class="col-sm-2 col-form-label">Caption</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="caption<?php echo $slide['ID']; ?>" name="caption"  value="<?php echo $slide['caption'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="custom-file ">
                                        <input type="file" class="form-control-file" id="img<?php echo $slide['ID']; ?>" name="img" >
                                        <label class="custom-file-label " for="img<?php echo $slide['ID']; ?>" >Choose file...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="submit" class="form-control" name="<?php echo $slide['ID']; ?>" />
                                </div>
                            </div>

                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                            if (isset($_POST[$slide['ID']])){
                                $slider -> edit($slide['ID'],$_POST['head'],$_POST['caption'],$_FILES['img']['name'],$_FILES['img']['size'],$_FILES['img']['tmp_name']);
                            }
                        }
                    }
                ?>
            </div>
            <?php
    } elseif (isset($_GET['delete'])){

        $id = isset($_GET['id']) ? $_GET['id'] : header('index.php?go=dashboard ') ;

        if ($slider -> check($id) > 0){
            $slider -> delete($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ../index.php' );
            exit;
        }

    }else {
        ?>
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide my-5"  data-ride="carousel">
                <div class="carousel-inner" style="height: 500px">
                    <?php
                        $slides = $slider ->viewAll();
                        $active = 1;
                        foreach ($slides as $slide){
                            ?>
                            <div class="carousel-item <?php  if($active == 1){ echo 'active'; $active++; } ?>">
                                <img class="d-block w-100" src="<?php echo $sliderPath . $slide['img']; ?>" alt="<?php echo $slide['head']; ?>">
                            </div>
                            <?php
                        }
                    ?>
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
            <a href="index.php?go=website&add" class="btn bg-dark text-white my-1 mx-2 fa-pull-right">Add Slide</a>
            <a href="index.php?go=website&edit" class="btn bg-dark text-white my-1 mx-2 fa-pull-right">Edit</a>
        </div>

        <?php
    }