<?php

    if (isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }

    $user = new  user($con);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        if (isset($_POST['sign'])){

            $visiter = $user -> checkUser($_POST['name']);

            if ($visiter > 0){
                echo '<p class="container alert bg-white my-2 text-danger" style="border-color:#F90A0A">UserName "' . $_POST['name'] . '" Is Already Exist</p>';
            } else {
                $user -> create($_POST['name'],$_POST['email'],$_POST['pass']);

                $visiter = $user -> checkName($_POST['name']);

//                $_SESSION['username'] = $_POST['name'];
//                $_SESSION['id'] =   $visiter['ID'];
//
//
//                header('location: index.php');
//                exit();
            }

        } else {

            $visiter = $user -> checkName($_POST['name']);

            if (password_verify($_POST['pass'],$visiter['password'])){

                $_SESSION['username'] = $_POST['name'];
                $_SESSION['id'] =   $visiter['ID'];

                if ($visiter['GroupID'] == 1){

                    header('location: admin/index.php?go=dashboard');
                    exit();

                } else {

                    header('location: index.php');
                    exit();

                }


            } else {
                echo '<p class="container alert bg-white my-2 text-danger" style="border-color:#F90A0A">Please Enter Username And Password Right</p>';
            }

        }
    }

    if (isset($_GET['sign'])){
        ?>
        <div class="container d-flex justify-content-center">
            <form class="form" id="registration_form" method="POST" name="sign" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=join&sign">
                <h2> Join Us  </h2>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_name"> UserName</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="form_name" name="name">
                        <span class="text-danger" id="name_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_email"> Email  </label>
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <input type="email" class="form-control" id="form_email" name="email" />
                        <span class="text-danger" id="email_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_password"> PassWord </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_password" name="pass" />
                        <span class="text-danger" id="password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_retype_password"> Re-Type PassWord </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_retype_password" />
                        <span class="text-danger" id="retype_password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row" style="display:flex ; justify-content:center ;">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" style="width: 100px ; background-color: rgb(41, 104, 104) ; border: none ;
                border-radius: 15px ; color: wheat ; display: block ; margin-top: 7px ; margin: auto" name="sign" > Submit
                        </button>
                    </div>
                </div>
                <a href="index.php?go=join&login" >Do You Already Have Account ? </a>
            </form>
        </div>
        <?php
    } elseif (isset($_GET['login'])){
        ?>
        <div class="container d-flex justify-content-center">
            <form class="form" method="POST" name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=join&sign">
                <h2> login in   </h2>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_name"> UserName</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="form_name" name="name">
                        <span class="text-danger" id="name_error_message"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="form_password"> PassWord </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="form_password" name="pass" />
                        <span class="text-danger" id="password_error_message"></span>
                    </div>
                </div>
                <div class="form-group row" style="display:flex ; justify-content:center ;">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" style="width: 100px ; background-color: rgb(41, 104, 104) ; border: none ;
                border-radius: 15px ; color: wheat ; display: block ; margin-top: 7px ; margin: auto" name="login" > Submit
                        </button>
                    </div>
                </div>
                <a href="index.php?go=join&sign" >Do You Want To Create Account ?  </a>
            </form>
        </div>
        <?php
    } else {
        header('location: index.php?go=join&sign');
    }