<!-- Dans cette page il s'agit de la vue détailActeur pour afficher les détails d'une acteur à l'utilisateur
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
    <title>Détails cachet</title>
</head>
<body>
    <?php require_once 'navbarView.php'; ?>
    <br>

    <h3>Détail cachet : </h3>

    <div class="principal">
        
        <?php echo $data["Cachet"]->acteur_prenom. " " . $data["Cachet"]->acteur_nom." a joué dans ".$data["Cachet"]->film_titre." pour ". $data["Cachet"]->cachet_tournage. " €"; ?>
    </div>

    <hr/>

    <h3>Mettre à jour montant : </h3>

    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form action ="index.php?controller=Cachet&action=update" method ="post">
                <input type="hidden" name="film_id" value="<?php echo $data["Cachet"]->film_id ?>"/>
                <input type="hidden" name="acteur_id" value="<?php echo $data["Cachet"]->acteur_id ?>"/>
                <div class="mb-3">
                    <label for="cachet_tournage" class="form-label">Montant cachet (€)</label>
                    <input type="number" class="form-control" id="cachet_tournage" name="cachet_tournage" value="<?php echo $data["Cachet"]->cachet_tournage ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>