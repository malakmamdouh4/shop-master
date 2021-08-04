<!--<div class="container">-->
    <div id="carouselExampleIndicators" class="carousel slide"  data-ride="carousel">
        <div class="carousel-inner" >
            <?php
            $slider = new slider($con);
            $slides = $slider ->viewAll();
            $active = 1;
            foreach ($slides as $slide){
                ?>
                <div class="carousel-item <?php  if($active == 1){ echo 'active'; $active++; } ?>">
                    <img class="d-block w-100 slider-img" src="<?php echo $path . $slide['img']; ?>" alt="<?php echo $slide['head']; ?>" >
                </div>
                <?php
            }
            ?>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next" >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>

    <div class="container">
        <div class="parent">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="image">
                        <img src="layout/images/43.jpg">
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="info row">
                        <div class="col-md-6 col-sm-12">
                            <div class="h-75">
                                <h4>   SEE ALL SERVICES  </h4>  <hr>
                                <span class="d-flex justify-content-center">
                                    <a href="index.php?go=dept" class="btn rounded-0 mb-2"> All services </a>
                                </span>
                            </div>
                        </div>
                        <?php
                            $dept = new department($con);
                            $depts = $dept -> viewHome();
                            foreach ($depts as $dept){
                                ?>
                                <div class="col-md-6 col-sm-12 text-center">
                                    <div>
                                        <i class="<?php if(strtolower($dept['name']) == "bedroom"){
                                                            echo 'fas fa-bed fa-5x';
                                                        } elseif(strtolower($dept['name']) == 'living room'){
                                                            echo 'fas fa-couch fa-5x';
                                                        } elseif (strtolower($dept['name']) == 'dining room'){
                                                            echo 'fas fa-chair fa-5x';
                                                        } else {
                                                            echo 'fas fa-chair fa-5x';
                                                        } ?> mt-1 "
                                           style="color:rgb(207, 67, 86);"></i>
                                        <h5 class="text-capitalize"> <?php echo $dept['name'] ?> </h5> <hr>
                                        <p> <?php echo $dept['description'] ?> </p>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="Projects">
        <h2>  Latest Items  </h2>
        <p> We know furniture shopping is not easy. Visit us, and let our experts give you a hand. Enjoy the ultimate shopping experience. At DE.CI Home, we strive to make things easier and better, by providing you with what suits you the most.</p>  <br>
    </div>
    <div class="portfolio">
        <div class="row">
            <?php
                $item = new items($con);
                $items = $item -> viewHome();
                foreach ($items as $item){
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="index.php?go=item&id=<?php echo $item['ID']; ?>"><img src="<?php echo $itemPath . $item['img'] ?>"></a>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>




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
