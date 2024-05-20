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
    <title>Films</title>
</head>

<body>

    <?php require_once 'navbarView.php'; ?>

    <div>
        <h3>Films</h3>
        <form action="index.php?controller=Film&action=index" method="post" class="d-flex align-items-center" style="width:fit-content;margin-left:auto;margin-right:auto">
            <div class="form-group me-2">
                <select id="categorie_" name="categorie_" class="form-select" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach($data["categories"] as $categorie) {?>
                    <option value="<?php echo $categorie["categorie_id"]; ?>"><?php echo $categorie["categorie_nom"]; ?></option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Trier</button>
        </form>
        <hr/> 
    </div>
    
    <div class="core justify-content-center">
        <?php
        if($data["films"] == null){
            echo "Aucun film à afficher";
        }else{

        foreach($data["films"] as $film) {?>

        <div class="container">
            <a href="index.php?controller=film&action=detail&id=<?php echo $film['film_id']; ?>">
                <img src="./img/<?php echo $film["film_image"]; ?>">
            </a>
            <br>
            <?php echo $film["film_titre"]; ?>
            <br>
            <?php $etoilevide = 5-$film["film_note"]; for($i = 0;$i<$film["film_note"];$i++){echo "★";} for($i = 0;$i<$etoilevide;$i++){echo "☆";} ?>
            <br>
            <a href="index.php?controller=film&action=delete&id=<?php echo $film['film_id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </div>
        <?php }} ?>
    </div>

    <hr/> 
    <h3>Insérer un film</h3>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form action ="index.php?controller=Film&action=creation" method ="post">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" style="resize: none;" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image (URL)</label>
                    <input type="text" class="form-control" id="image" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" class="form-control" id="note" name="note" min="0" max="5" required>
                </div>
                <div class="mb-3">
                    <label for="lien" class="form-label">Lien</label>
                    <input type="text" class="form-control" id="lien" name="lien" required>
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie" name="categorie" required>
                        <?php foreach($data["categories"] as $categorie) {?>
                        <option value="<?php echo $categorie["categorie_id"]; ?>"><?php echo $categorie["categorie_nom"]; ?></option>
                        <?php }?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Insérer</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>