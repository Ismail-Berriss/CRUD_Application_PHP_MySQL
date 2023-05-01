<?php
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        require_once "config.php";

        $sql = "select * from user where id = ?";

        if($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $param_id);

            $param_id = trim($_GET["id"]);

            if($stmt->execute()) {
                $result = $stmt->get_result();

                if($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    $nom = $row["nom"];
                    $prenom = $row["prenom"];
                    $email = $row["email"];
                    $tel = $row["tel"];

                } else {
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Erreur! Veuillez réessayer plus tard.";
            }
        }

        $stmt->close();

        $conn->close();
    } else {
        header("location: error.php");
        exit();
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
    <title>Read</title>
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
                <input type="text" class="form-control" value="<?php echo $nom; ?>"
                       name="nom"
                       id="nom"
                       aria-label="First
                    name" disabled>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" value="<?php echo $prenom; ?>"
                       name="prenom" id="prenom"
                       aria-label="Last name" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?php echo $email; ?>"
                       name="email" id="exampleInputEmail1"
                       aria-describedby="emailHelp" disabled>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Tel</label>
                <input type="tel" class="form-control" value="<?php echo $tel; ?>" name="tel"
                       id="tel" disabled>
            </div>
            <a href="index.php" class="btn btn-primary ml-2">Retour</a>
        </form>
    </div>
</body>
</html>