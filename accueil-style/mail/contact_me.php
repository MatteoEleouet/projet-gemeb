<?php

if(empty($_POST['Nom'])           ||
   empty($_POST['email'])         ||
   empty($_POST['telephone'])     ||
   empty($_POST['message'])       ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Remplisez vos informations !";
   return false;
   }
   
$Nom = strip_tags(htmlspecialchars($_POST['Nom']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$telephone = strip_tags(htmlspecialchars($_POST['telephone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = 'noreply@gemeb.site'; 
$email_subject = "Formulaire de contact du site web :  $Nom";
$email_body = "Vous avez reçu un nouveau message à partir du formulaire de contact de votre site web.\n\n".
   "Voici les informations:\n\nNom: $Nom\n\nEmail: $email_address\n\nTelephone: $telephone\n\nMessage:\n$message";
$headers = "From: noreply@gemeb.site\n"; 
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;         
?>
