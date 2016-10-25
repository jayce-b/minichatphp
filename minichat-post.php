<?php
//test et message d'erreur si erreur
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');
}
catch(Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$pseudo = strip_tags($_POST['pseudo']);
$message = strip_tags($_POST['message']);


if ( isset($pseudo) AND isset($message) AND !empty($pseudo) AND !empty($message))
    {
        $insertmsg = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(?, ?)');
        $insertmsg->execute(array(
            $pseudo,
            $message));

        //Redirection URL
        header('location: minichat.php');
    }


//supprimer tous les messages de la table
if (isset($_POST['supprimer'])) {
    $delmsg = $bdd->prepare('TRUNCATE TABLE minichat');
    $delmsg->execute();

    //Redirection URL
    header('location: minichat.php');
}



//modifier le message en fonction de l'ID
if (isset($_POST['modifier']))
{
    $nvmessage = strip_tags($_POST['nvmessage']);
    $id = $_POST['id'];

    $updatemsg = "UPDATE minichat SET message='$nvmessage' WHERE id='$id'";
    $bdd->query($updatemsg);

    //Redirection URL
    header('location: minichat.php');
}

//supprimer message+pseudo en fonction du pseudo
if (isset($_POST['supprpseudo']))
{
    $supmsgpseudo = strip_tags($_POST['supmsgpseudo']);

    $delmsgpseudo = $bdd->prepare("DELETE FROM minichat WHERE pseudo=?");
    $delmsgpseudo->execute(array(
        $supmsgpseudo
    ));

    //Redirection URL
    header('location: minichat.php');

}

//supprimer message+pseudo en fonction de l'ID
if (isset($_POST['supprid']))
{
    $supmsgid = strip_tags($_POST['supmsgid']);

    $delmsgid = $bdd->prepare("DELETE FROM minichat WHERE id=?");
    $delmsgid->execute(array(
        $supmsgid
    ));

    //Redirection URL
    header('location: minichat.php');
}






