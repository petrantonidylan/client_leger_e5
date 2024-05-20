<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a href="index.php"><img src="./img/netflix.png" alt="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?controller=Film">Films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Categorie">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Acteur">Acteurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Cachet">Cachets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Film&action=log">Logs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=Connexion&action=logout"><?php echo $_SESSION['utilisateur_login']." "; ?><i class="fa-solid fa-power-off"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>