<nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light justify-content-between sticky-top">
    <a class="navbar-brand" href="#">BlogWebsite</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/pages/blogs">Blog</a>
            </li>
        </ul>

        <ul class="navbar-nav d-flex p-2 ms-auto">
            <?php if(!isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <a class="btn btn-primary me-sm-2" href="<?php echo URLROOT; ?>/users/login">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary me-sm-2" href="<?php echo URLROOT; ?>/users/register">Registreren</a>
                </li>
            <?php else : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/profile">Profiel</a>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout">Uitloggen</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>