<?php

include "connexion.php";

    $sqlCategorie = "SELECT * FROM categorie";
    $r = $connexion->query($sqlCategorie);
    $resultat = $r->fetchAll();

if(isset($_POST)){
    if(!empty($_POST["add_categorie"])) {
        $categorie = htmlspecialchars($_POST["add_categorie"]);

        $sql = "INSERT INTO categorie(nom_categorie) VALUES (:nomCat)";
        $resu = $connexion->prepare($sql);
        $resu->bindParam(":nomCat" , $categorie);
        $resu->execute();
        header("Refresh:0");

    }
    if(!empty($_POST["question"]) and !empty($_POST["categorie"])){
        $question = $_POST["question"];
        $categorie = htmlspecialchars($_POST["categorie"]);

        //var_dump($question);
        //var_dump($categorie);

        $sqlInsert = "INSERT INTO questions(nom_question,id_categorie) VALUES (:question , :categorie)";
        $resultatInsert = $connexion->prepare($sqlInsert);
        $resultatInsert->bindParam(":question", $question);
        $resultatInsert->bindParam(":categorie" , $categorie);
        $resultatInsert->execute();
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="qcmpublic/reset.css">
    <link rel="icon" href="qcmpublic/incendie.png">
    <link rel="stylesheet" href="qcmpublic/styleAjouter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <title>Ajout - QCM Sécurité</title>
</head>
<body>
    <div class="imgBackground">
        <div class="overlay">
            <header class="headAjouter">
                <h1>Ajouter une question</h1>
                <a href="index.php">Générer des questions</a>
            </header>

            <main class="mainAjout">
                <section class="sectionQuestions">
                    <form action="" method="post">
                        <textarea name="question" id="questionArea" cols="70" rows="15"></textarea>
                        <div class="bouton_cate">
                            <select name="categorie" id="select_categorie">
                                <option value="0">Choix d'une catégorie</option>
                                <?php foreach ($resultat as $value) : ?>
                                <option value="<?=$value->id_categorie?>"><?=$value->nom_categorie?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="Ajouter une question">
                        </div>
                    </form>
                </section>

                <div class="addCate">
                    <h1>Ajouter une catégorie</h1>
                </div>
                <section class="sectionCategorie">
                    <form action="" method="post">
                        <input id="ajouttexte" type="text" name="add_categorie">
                        <input id="ajoutSubmit" type="submit" value="Ajouter une catégorie">
                    </form>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
