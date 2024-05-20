<!-- Dans cette page il s'agit de la vue détailFilm pour afficher les détails d'un film à l'utilisateur
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
    <title>Détails film</title>
</head>
<body>
    <?php require_once 'navbarView.php'; ?>
    <br>

    <div class="principal">

        <div class="u1">
            <img src="./img/<?php echo $data["film"]->film_image; ?>">
        </div>

        <div class="u2">
            <b>Catégorie :</b> <?php echo $data["film"]->categorie_nom; ?><br><br>
            <b>Titre du film :</b> <?php echo $data["film"]->film_titre; ?><br><br>
            <b>Note :</b> <?php $etoilevide = 5-$data["film"]->film_note; for($i = 0;$i<$data["film"]->film_note;$i++){echo "★";} for($i = 0;$i<$etoilevide;$i++){echo "☆";} ?><br><br>
            <b>Date de sortie :</b> <?php echo $data["film"]->film_date; ?><br><br>
            <b>Description :</b> <?php echo $data["film"]->film_description; ?><br>
        </div>

        <div class="video-container">
            <iframe width="560" height="30" src="<?php echo $data["film"]->film_lien; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

    </div>

    <hr/>

    <h3>Mettre à jour :</h3>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form action ="index.php?controller=Film&action=update" method ="post">
                <input type="hidden" name="id" value="<?php echo $data["film"]->film_id ?>"/>
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $data["film"]->film_titre;?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" style="resize: none;" required><?php echo $data["film"]->film_description;?></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $data["film"]->film_date;?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image (URL)</label>
                    <input type="text" class="form-control" id="image" name="image" value="<?php echo $data["film"]->film_image;?>" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" class="form-control" id="note" name="note" min="0" max="5" value="<?php echo $data["film"]->film_note;?>" required>
                </div>
                <div class="mb-3">
                    <label for="lien" class="form-label">Lien</label>
                    <input type="text" class="form-control" id="lien" name="lien" value="<?php echo $data["film"]->film_lien;?>" required>
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie" name="categorie" required>
                        <option value="<?php echo $data["film"]->categorie_id;?>"><?php echo $data["film"]->categorie_nom; ?></option>
                        <?php foreach($data["categories"] as $categorie) {?>
                        <option value="<?php echo $categorie["categorie_id"]; ?>"><?php echo $categorie["categorie_nom"]; ?></option>
                        <?php }?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <br><br><br><br><br><br>

</body>
</html>