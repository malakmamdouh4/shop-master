
<div class="container">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?go=search">
        <div class="form-group position-relative">
            <input type="search" class="form-control" placeholder="Search For Items" name="search">
            <button type="submit" class="btn btn-light position-absolute" style="top: 0;right: 0;"><i class="fa fa-search"></i>Search </button>
        </div>
    </form>
</div>

<?php
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
//            echo $_POST['search'];
            if (empty($_POST['search'])){
                echo '<p class="container alert alert-light my-3">Not Found</p>';
            } else {
                $item = new items($con);
                $items = $item->search($_POST['search']);
                if (empty($items)) {
                    echo '<p class="container alert alert-light my-3">Not Found</p>';
                } else {
                    ?>
                    <div class="container">
                        <div class="row">
                            <?php
                            foreach ($items as $item) {
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
                                            <a href="index.php?go=item&id=<?php echo $item['ID']; ?>" class="btn show-more">
                                                Show More....</a>
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
            }

        }

?>