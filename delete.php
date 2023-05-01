<?php

    if(isset($_POST["id"]) && !empty($_POST["id"])) {

        require_once "config.php";

        $sql = "delete from user where id = ?";

        if($stmt = $conn->prepare($sql)) {

            $stmt->bind_param("i", $param_id);

            $param_id = trim($_POST["id"]);

            if($stmt->execute()) {

                header("location: index.php");
                exit();

            } else {

                echo "Erreur! Veuillez réessayer plus tard.";

            }

        }

        $stmt->close();

        $conn->close();

    } else {

        if(empty(trim($_GET["id"]))) {

            header("location: error.php");
            exit();

        }

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
    <title>delete</title>
    <style>
        .container {
            width: 600px;
            margin: 50px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert alert-danger">
                    <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                    <p>Etes-vous sure que vous voullez supprimer cet utilisateur?</p>
                    <p>
                        <input type="submit" value="Oui" class="btn btn-danger">
                        <a href="index.php" class="btn btn-secondary ml-2">Non</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
