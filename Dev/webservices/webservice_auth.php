<?php
// On ajoute l'en_tete pour la connexion etc
require_once "entete.php";

// TODO BRUTEFORCE recuperation de l'ip du visiteur pour pr�venir le brute force 
$ipVisiteur = $_SERVER["REMOTE_ADDR"];

//v�rification des param�tres de la requete
if(isset($_GET['login'])&&isset($_GET['lama']))
{

	//pr�paration de la requete SQL avec PDO
	$sql = $dbh->prepare("Select id, password, nbEssais,bannedUntil from users where login=?");

	//ex�cution de la requete
	$sql->execute(array($_GET['login']));

	//r�cup�ration des r�sultats de la requete
	$resSQL = $sql->fetchAll();

	if(sizeof($resSQL) == 1)
	{
		$bannedUntil = $resSQL[0]['bannedUntil'];
		if(is_null($bannedUntil))
		{
			$password = $resSQL[0]['password'];
			$id = $resSQL[0]['id'];
			//salage A REVOIR
			$passSend = md5($_GET['lama'].SEL);

			if($password == $passSend)
			{
				$sql = $dbh->prepare("UPDATE users SET bannedUntil = NULL AND nbEssais = 0 Where ");
				$resSQL = $sql->execute(array($id));
				$res = json_encode(array('token'=>'testdetoken','resup' => print_r($resSQL)));
			}else{
				$res = json_encode(array('erreur'=>'mauvais login ou pass'));

			}
		}else{
			$res = json_encode(array('erreur'=>'Utilisateur banni'));
		}
		
	}else{
		$res = json_encode(array('erreur'=>'mauvais login ou pass'));
	}


}else{
	$res = json_encode("erreur parametre");
}

print_r(json_decode($res));

?>