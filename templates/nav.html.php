<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <a class='navbar-brand' href=''>Vidéo2000</a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarColor02' aria-controls='navbarColor02' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>

    <div class='collapse navbar-collapse' id='navbarColor02'>
        <ul class='navbar-nav mr-auto'>
            <?php if(isset($_SESSION['pseudo'])) : ?>
                <li class='nav-item'>
                    <a class='nav-link disabled' href='user_pref.php'>Bonjour <?= $_SESSION['pseudo']; ?>
                        <?php if (!empty($_SESSION['avatar'])) : ?>
                            <img src='<?= $_SESSION['avatar']; ?>' width="40px">
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(isset($_SESSION['role'])) : ?>
                <?php if($_SESSION['role'] === "admin") : ?>
                <li style="display: flex;align-items: center;" class='nav-item'>
                    <a class='nav-link' href='admin.php'>Administration</a>
                </li>
                <?php endif; ?> 
            <?php endif; ?>
        </ul>
        <form style="display: flex;flex-direction: column;position: absolute;left: 85vw;top: 2vh;z-index: 1;" class='form-inline my-2 my-lg-0'>
            <input class='form-control mr-sm-2' type='text' id="searchFilm" placeholder='Recherche'>
            <div style="text-align: left;background-color: white;width: 12vw;" id="renderTitle"></div>
        </form>
    </div>
</nav>