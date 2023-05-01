<?php

    require_once "config.php";

    $nom = $prenom = $email = $tel = "";
    $nom_err = $prenom_err = $email_err = $tel_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // nom
        $input_nom = trim($_POST["nom"]);
        if(empty($input_nom)) {
            $nom_err = "Saisir un nom.";
        } elseif (!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" =>
            "/^[a-zA-Z\s]+$/")))) {
            $nom_err = "Saisir un nom valide.";
        } else {
            $nom = $input_nom;
        }

        // prénom
        $input_prenom = trim($_POST["prenom"]);
        if(empty($input_prenom)) {
            $prenom_err = "Saisir un prenom.";
        } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $prenom_err = "Saisir un prenom valide";
        } else {
            $prenom = $input_prenom;
        }

        // email
        $input_email = trim($_POST["email"]);
        if (empty($input_email)) {
            $email_err = "Saisir un email.";
        } elseif (!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Saisir un email valide.";
        } else {
            $email = $input_email;
        }
        // tel
        $input_tel = trim($_POST["tel"]);
        if(empty($input_tel)) {
            $tel_err = "Saisir un numéro de téléphone.";
        } elseif(!preg_match("/^[0-9]{10}$/", $input_tel)) {
            $tel_err = "Saisir un numéro de téléphone valide (10 chiffres).";
        } else {
            $tel = $input_tel;
        }

        if(empty($nom_err) && empty($prenom_err) && empty($email_err) && empty($tel_err)) {
            $sql = "insert into user (nom, prenom, email, tel) values (?, ?, ?, ?)";

            if($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssss", $param_nom, $param_prenom, $param_email, $param_tel);
                $param_nom = $nom;
                $param_prenom = $prenom;
                $param_email = $email;
                $param_tel = $tel;

                if($stmt->execute()) {
                    header("location: index.php");
                    exit();
                } else {
                    echo "Erreur! Veuillez réessayer plus tard.";
                }
            }

            $stmt->close();
        }

        $conn->close();
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap 05 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <title>Insert</title>
    <style>
        .container {
            width: 600px;
            margin: 50px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>"
                       name="nom"
                       id="nom"
                       aria-label="First
                name">
                <span class="invalid-feedback"><?php echo $nom_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>"
                       name="prenom" id="prenom"
                       aria-label="Last name">
                <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                       name="email" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Tel</label>
                <input type="tel" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>" name="tel"
                       id="tel">
                <span class="invalid-feedback"><?php echo $tel_err; ?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>
