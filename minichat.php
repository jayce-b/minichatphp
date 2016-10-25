<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>exercice mini-chat</title>
</head>

<body>

<header>
    <h1>Minichat PHP</h1>
</header>

<form method="POST" action="minichat-post.php">
    <h3>Chatez ici !</h3>
    <input type="text" name="pseudo" placeholder="Votre PSEUDO"/>
    <textarea name="message" placeholder="Votre MESSAGE"></textarea><br>
    <input type="submit" value="Envoyer"> <br>
    <input type="submit" name="supprimer" value="Tout supprimer">

</form>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');

$allmsg = $bdd->query('SELECT * FROM minichat ORDER BY id DESC LIMIT 0, 10');
while ($msg = $allmsg->fetch())
{
?>
    <p>
        <?php
        echo $msg['id'] . ' - ' . $msg['pseudo'] . ' : ' . $msg['message'];
        ?>
    </p>
<?php
}
?>

<form method="POST" action="minichat-post.php">
    <h3>Modifier votre message !</h3>

    <p>identifiant</p>
    <input type="text" name="id" placeholder="Votre ID">
    <textarea name="nvmessage" placeholder="Votre MESSAGE"></textarea><br>
    <input type="submit" name="modifier" value="Modifier">
</form>

<form method="POST" action="minichat-post.php">
    <p>Suppression de message via pseudo</p>
    <input type="text" name="supmsgpseudo" placeholder="votre PSEUDO">
    <input type="submit" name="supprpseudo" value="Valider">

    <p>Suppression de message via id</p>
    <input type="text" name="supmsgid" placeholder="votre ID">
    <input type="submit" name="supprid" value="Valider">
</form>


</body>
</html>
