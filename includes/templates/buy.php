<?php

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $item = new items($con);
        $client = new client($con);

        if($item -> check($id) > 0){
            $itemBuy = $item -> itemInfo($id);
            if (isset($_SESSION['id'])){
                if ($_SESSION['id'] === $itemBuy['user_ID']){
                    header('location:index.php');
                    exit();
                }
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $client -> create($_POST['name'],$_POST['address'],$_POST['phone'],$_POST['email'],$id,$itemBuy['user_ID'],$itemBuy['dept_ID']);
            }

            ?>
            <div class="container">
                <h1 class="text-center row my-5"><div class="col-5"><?php echo $itemBuy['name']; ?></div><div class="col-5 "><span class="fa-pull-right">$<?php echo $itemBuy['price']; ?></span></div> </h1>
                <form class="w-100" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=buy&id=<?php echo $id; ?>">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="form_name">Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="form_name" name="name" />
                            <span class="text-danger" id="name_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="form_address">Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="form_address" name="address" />
                            <span class="text-danger" id="address_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="form_phone">Phone</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="form_phone" name="phone" />
                            <span class="text-danger" id="phone_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <label for="form_email">E-Mail</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <input class="form-control" type="text" id="form_email" name="email" />
                            <span class="text-danger" id="email_error_message"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input class="form-control" type="submit" name="buy" />
                        </div>
                    </div>
                </form>
            </div>
            <?php
        } else {
            header('location: index.php');
            exit();
        }
    }
?>

