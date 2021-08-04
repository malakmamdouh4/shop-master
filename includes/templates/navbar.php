        <nav class="nav navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="index.php?go=home"> <span style="font-weight: bold ;font-size: 30px ;color: brown ;font-family: 'Dancing Script', cursive;"> Furniture </span> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav">
                    <!-- aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" -->
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if(!isset($_GET['go']) || $_GET['go'] === 'home'){ echo 'active';} ?>">
                            <a class="nav-link" href="index.php?go=home">Home </span></a>
                        </li>
                        <li class="nav-item <?php if((isset($_GET['go']) && $_GET['go'] === 'dept') || (isset($_GET['go']) && $_GET['go'] == 'item' ) || (isset($_GET['go']) && $_GET['go'] == 'buy' )){ echo 'active';} ?>">
                            <a class="nav-link" href="index.php?go=dept">departments</a>
                        </li>
                        <li class="nav-item <?php if(isset($_GET['go']) && $_GET['go'] === 'search'){ echo 'active';} ?>">
                            <a class="nav-link" href="index.php?go=search"><i class="fa fa-search"></i> Search  </span></a>
                        </li>
                        <?php
                            if (!isset($_SESSION['username'])){
                                ?>
                                <li class="nav-item <?php if(isset($_GET['go']) && $_GET['go'] === 'join'){ echo 'active';} ?>">
                                    <a class="nav-link" href="index.php?go=join">Join Us</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="nav-item dropdown <?php if(isset($_GET['go']) && $_GET['go'] === 'profile'){ echo 'active';} ?>">
                                    <?php
//                                        include $user;
                                        $user = new user($con);
                                        $visitor = $user -> view($_SESSION['id']);
                                    ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <?php
//                                            if (empty($visitor['avater'])){
//                                                ?>
<!--                                                <i class="fa fa-user"></i>-->
<!--                                                --><?php
//                                            } else {
//                                                ?>
<!--                                                <img src="--><?php //echo $avaterPath . $visitor['avater'];?><!--"-->
<!--                                                     class="img-thumbnail rounded-circle"-->
<!--                                                     style="width: 40px;height: 40px" />-->
<!--                                                --><?php
//                                            }
                                       ?>

                                        <i class="fa fa-user"></i> <?php echo $visitor['name']; ?>
                                    </a>
                                    <?php
                                        if ($visitor['GroupID'] == 1){
                                            ?>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="admin/index.php?go=dashboard">Dashboard</a>
                                                <a class="dropdown-item" href="index.php?go=logout">logout</a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="index.php?go=profile">Profile</a>
                                                <a class="dropdown-item" href="index.php?go=logout">logout</a>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
