<?php

if(isset($_POST["ide"]) && !empty($_POST["ide"])) {

    require_once "config.php";

    $sql = "delete from user where id = ?";

    if($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $param_id);

        $param_id = trim($_POST["ide"]);

        if($stmt->execute()) {

            header("location: index.php");
            exit();

        } else {

            echo "Erreur! Veuillez réessayer plus tard.";

        }

    }

    $stmt->close();

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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Main CSS File -->
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
<body>
    <div class="holder">
        <a class="ajouter" href="insert.php">Ajouter</a>
        <div class="table">
            <?php
                require_once "config.php";

                $sql = "select * from user";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    echo '<table> <tr><th> id </th><th> Nom </th><th>prenom</th><th>email</th><th>tel</th><th>Action</th></tr>';

                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $row["id"] . '</td>';
                            echo '<td>' . $row["nom"] . '</td>';
                            echo '<td>' . $row["prenom"] . '</td>';
                            echo '<td>' . $row["email"] . '</td>';
                            echo '<td>' . $row["tel"] . '</td>';
                            echo '<td>';
                                echo '<a href="read.php?id=' . $row["id"] . '"><i class="fa-solid fa-eye"></i></a>';
                                echo '<a href="modifier.php?id=' . $row["id"] .'"><i class="fa-solid fa-pen"></i></a>';
                                echo '<a type="button" data-bs-toggle="modal" data-bs-target="#suppModal' . $row["id"] . '"><i class="fa-solid fa-trash"></i></a>';
                                ?>
                                    <div class="modal fade" id="suppModal<?php echo $row['id']; ?>" tabindex="-1"
                                    aria-labelledby="suppModal<?php echo $row['id']; ?>Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="suppModal<?php echo $row['id']
                                                    ?>Label">Supprimer personne</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous supprimer cette personne?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                    <button type="button" class="btn btn-primary">
                                                        <input type="hidden" name="ide" value="<?php echo $row['id'];
                                                        ?>"/>
                                                        <input type="submit" value="Supprimer" class="btn btn-danger">
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            echo '</td>';
                        echo'<tr>';
                    }

                    echo '</table>';
                }
            ?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>