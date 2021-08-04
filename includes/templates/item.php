<?php
    $item = new items($con);
if (isset($_GET['id'])){

//    echo 'item';
//    if (isset($_GET['id'])){
        $id = $_GET['id'];

        if($item -> check($id) > 0){
            $itemPage = $item -> itemInfo($id);
            ?>
            <div class="container">

                <div class="row" style="width: 90%;margin: auto;margin-top: 30px;margin-bottom: 30px;">
                    <div class="first col-md-6 col-sm-12 ">
                        <img src="<?php echo $itemPath . $itemPage['img']; ?>" style="width: 100%;border-radius: 5%;margin-bottom: 20px">
                    </div>
                    <div class="second col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 style="width: 90%;margin: auto;margin-bottom: 20px;padding: 10px;font-size: 20px;text-align: center;background-color: rgb(161, 117, 120);color: #FFFFFF;" >  PRODUCT PARAMETER  </h4>
                                <p> Name :     <span class="Dis" style="margin-left: 100px;">    <?php echo $itemPage['name']; ?>           </span> </p>
                                <p> Price :     <span class="Dis" style="margin-left: 100px;">    <?php echo $itemPage['price']; ?>$        </span> </p>
                                <p> Department :     <span class="Dis" style="margin-left: 100px;">    <?php echo $itemPage['dept']; ?>         </span> </p>
                                <p> Date :    <span class="Dis" style="margin-left: 100px;">    <?php echo time_ago($itemPage['date']); ?>           </span> </p>
                                <p> Material :  <span class="Dis" style="margin-left: 100px;">    Solid wood frame,Leather  </span> </p>
                            </div>
                            <div class="col-sm-12">
                                <h6> OTHER DESCRIPTION  </h6>
                                <h6> CUSTOMER SERVICE  </h6>
                                <p> 1. Different sizes and different colors are for your choice. </p>
                                <p> 2. If there is any damage during shipping, we can provide you with replacement of broken parts for
                                    free after confirmation.   </p>
                                <p> 3. Our Products are 100% for export, with Europe and U.S. as the main export zone. We
                                    only use high-quality materials and high-end manufacturing technology.   </p>
                                <p> 4. All the Products obtained the approval of Professional Certification Authority.  </p>
                                <p> 5.Package consists of three layers (foam, paper box and wooden frame from inner to outer), which is specially made
                                    for export. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="index.php?go=buy&id=<?php echo $itemPage['ID']; ?>" class="btn w-100 mb-5" style="background-color: rgb(161, 117, 120);color: #FFFFFF;">Buy</a>
                    <?php
                    $related = $item -> related($itemPage['dept_ID']);
                    ?>

                        <?php
                        if (!empty($related)){
                            ?>
                            <h5>Related</h5>
                            <div class="row mb-5">

                            <?php
                            foreach ($related as $item){
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 ">
                                    <a href="index.php?go=item&id=<?php echo $item['ID']; ?>">
                                        <img src="<?php echo $itemPath . $item['img']; ?>" class="w-100" style="height: 200px">
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            <?php
                        }
                        ?>


            </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }
//    } else {
//        header('location: index.php');
//        exit();
//    }

}