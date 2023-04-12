<?php

include "connexion.php";

$sqlCate = "SELECT * FROM categorie";
$resultat = $connexion->query($sqlCate);
$re = $resultat->fetchAll();

if(isset($_POST)){
    if(!empty($_POST["nbQuestions"]) and !empty($_POST["selectCate"])){
        $nbQuestions = htmlspecialchars($_POST["nbQuestions"]);
        $categorie = htmlspecialchars($_POST["selectCate"]);
        $i = 1;

        $sql = "SELECT nom_question FROM questions WHERE id_categorie = '{$categorie}' ORDER BY RAND() LIMIT $nbQuestions";
        $res = $connexion->query($sql);
        $resultatAleatoire = $res->fetchAll();

        $open = fopen("filetexte.txt" , "w");

        foreach ($resultatAleatoire as $nom){
            fwrite($open , $i." - ".$nom->nom_question."\n\n");
            $i = $i + 1;
        }
        fclose($open);
        $download = "Prêt";
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
    <link rel="stylesheet" href="qcmpublic/styleIndex.css">
    <link rel="icon" href="qcmpublic/incendie.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <title>Générateur - QCM Sécurité</title>
</head>
<body>
    <div class="imgBackground">
        <div class="overlay">
            <header class="headIndex">
                <h1>Générateur - QCM Sécurité</h1>
                <a href="ajouter.php">Ajouter une question/catégorie</a>
            </header>


            <main class="mainIndex">
                <section class="sectionGenerer">
                    <form action="" method="post">
                        <select name="nbQuestions" id="nbrQuestions">
                            <option value="10">10 questions</option>
                            <option value="20">20 questions</option>
                            <option value="30">30 questions</option>
                            <option value="40">40 questions</option>
                        </select>

                        <select name="selectCate" id="selectCate">
                            <option value="0">Choix d'une catégorie</option>
                            <?php foreach ($re as $value) : ?>
                            <option value="<?=$value->id_categorie?>"><?=$value->nom_categorie?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="Générer les questions">
                    </form>
                </section>
                <?php if(isset($download)) : ?>
                <div class="dl">
                    <a href="filetexte.txt" download="questions">Téléchargez</a>
                </div>
                <?php endif;?>
            </main>
        </div>
    </div>
</body>
</html>
