<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //Créer une session avec ID
     $session->login($user_id);
    //Mettre à jour l’heure de connexion
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenue dans le système de gestion des stocks");
     redirect('admin.php',false);

  } else {
    $session->msg("d", "Désolé Nom d’utilisateur/mot de passe incorrect.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>
