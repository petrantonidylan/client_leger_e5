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
    <title>Cachets</title>
</head>

<body>

    <?php require_once 'navbarView.php'; ?>

    <div>
        <h3>Cachets</h3>
        <hr/> 
    </div>
    
    <div class="core">
        <?php foreach($data["Cachets"] as $cachet) {?>
            - <a href="index.php?controller=Cachet&action=detail&film_id=<?php echo $cachet['film_id']?>&acteur_id=<?php echo $cachet['acteur_id']?>" class="btn btn-primary btn-sm"><?php echo $cachet['acteur_prenom'] . " " . $cachet['acteur_nom'] . " a joué dans " . $cachet['film_titre']." pour ".$cachet['cachet_tournage']." €"; ?></a> <a href="index.php?controller=Cachet&action=delete&acteur_id=<?php echo $cachet['acteur_id']; ?>&film_id=<?php echo $cachet['film_id'];?>" class="btn btn-danger btn-sm">Supprimer</a><br><br>
        <?php } ?>
    </div>

    <hr/> 
    <h3>Insérer un Cachet</h3>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form action ="index.php?controller=Cachet&action=creation" method ="post">
                <div class="mb-3">
                    <label for="acteur_id" class="form-label">Acteur</label>
                    <select class="form-select" id="acteur_id" name="acteur_id" required>
                        <option value="">-- Choisissez un acteur --</option>
                        <?php foreach($data["Acteurs"] as $acteur) {?>
                        <option value="<?php echo $acteur["acteur_id"]; ?>"><?php echo $acteur["acteur_prenom"]." ".$acteur["acteur_nom"]; ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="film_id" class="form-label">Film</label>
                    <select class="form-select" id="film_id" name="film_id" required>
                        <option value="">-- Choisissez un film --</option>
                        <?php foreach($data["Films"] as $film) {?>
                        <option value="<?php echo $film["film_id"]; ?>"><?php echo $film["film_titre"]; ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cachet_tournage" class="form-label">Montant cachet (€)</label>
                    <input type="number" class="form-control" id="cachet_tournage" name="cachet_tournage" required>
                </div>
                <button type="submit" class="btn btn-primary">Insérer</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>