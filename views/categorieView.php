<!-- Dans cette page il s'agit de la vue FilmView pour afficher tous les films
Les infos sont poussé par le controller -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Catégories</title>
</head>

<body>

    <?php require_once 'navbarView.php'; ?>

    <div>
        <h3>Catégories</h3>
        <hr/> 
    </div>
    
    <div class="core">
        <?php foreach($data["Categories"] as $categorie) {?>
            - <a href="index.php?controller=Categorie&action=detail&id=<?php echo $categorie['categorie_id']; ?>" class="btn btn-primary btn-sm"><?php echo $categorie['categorie_nom']; ?></a> <a href="index.php?controller=Categorie&action=delete&id=<?php echo $categorie['categorie_id']; ?>" class="btn btn-danger btn-sm">Supprimer</a><br><br>
        <?php } ?>
    </div>

    <hr/> 
    <h3>Insérer une Catégorie</h3>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form action ="index.php?controller=Categorie&action=creation" method ="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <button type="submit" class="btn btn-primary">Insérer</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>