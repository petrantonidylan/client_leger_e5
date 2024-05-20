<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Logs</title>
</head>

<body>

    <?php require_once 'navbarView.php'; ?>

    <div class="container mt-5">
    <h2 class="mb-4">Journal des tentatives de connexion</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Tentative</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($data["logs"] as $log) {
            if($log['log_success']){$s = "Réussie";}else{$s="Échouée";}
            echo "
            <tr>
                <th scope='row'>".$log['log_id']."</th>
                <td>".$log['utilisateur_login']."</td>
                <td>".$s."</td>
                <td>".$log['log_date']."</td>
            </tr>
            ";
        }?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Lien vers Bootstrap JS et ses dépendances -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>