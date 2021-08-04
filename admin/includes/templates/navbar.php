        <nav class="nav navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="../index.php"> <span> Furniture </span> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav">
                    <!-- aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" -->
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="main-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if((!isset($_GET['go']) || $_GET['go'] === 'dashboard') || $_GET['go'] === 'users' || $_GET['go'] === 'admins' || $_GET['go'] === 'departments' || $_GET['go'] === 'items'){ echo 'active';} ?>">
                            <a class="nav-link" href="index.php?go=dashboard">Dashboard</span></a>
                        </li>
                        <li class="nav-item <?php if(isset($_GET['go']) && $_GET['go'] === 'website'){ echo 'active';} ?>">
                            <a class="nav-link" href="index.php?go=website">Website Edit</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
